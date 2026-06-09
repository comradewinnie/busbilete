<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Tariff;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\Trip;
use Illuminate\Http\Request;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function createSession()
    {
        $cartData = session('cart', []);

        if (empty($cartData)) {
            return redirect()->route('cart.index')->with('error', 'Grozs ir tukšs.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];

        foreach ($cartData as $item) {
            $trip = Trip::with('tripPlan.route')->find($item['trip_id']);
            $tariff = Tariff::with(['fromStop', 'toStop'])->find($item['tariff_id']);
            $category = TicketCategory::find($item['ticket_category_id']);

            if (!$trip || !$tariff || !$category) {
                continue;
            }

            $price = round($tariff->price * $category->multiplier, 2);

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $trip->tripPlan->route->name . ': ' . $tariff->fromStop->name . ' → ' . $tariff->toStop->name . ' (' . $category->name . ')',
                    ],
                    'unit_amount' => (int)($price * 100),
                ],
                'quantity' => 1,
            ];
        }

        $stripeSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('payment.cancel'),
        ]);

        return redirect($stripeSession->url);
    }

    public function success(Request $request)
    {
        $cartData = session('cart', []);

        if (empty($cartData) || !$request->filled('session_id')) {
            return redirect()->route('home');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $stripeSession = StripeSession::retrieve($request->session_id);

        if ($stripeSession->payment_status !== 'paid') {
            return redirect()->route('cart.index')
                ->with('error', 'Maksājums netika pabeigts.');
        }

        $payment = Payment::create([
            'stripe_payment_id' => $stripeSession->payment_intent,
            'amount' => $stripeSession->amount_total / 100,
            'status' => 'paid',
        ]);

        foreach ($cartData as $item) {
            $tariff = Tariff::find($item['tariff_id']);
            $category = TicketCategory::find($item['ticket_category_id']);

            if (!$tariff || !$category) {
                continue;
            }

            Ticket::create([
                'ticket_category_id' => $item['ticket_category_id'],
                'price' => round($tariff->price * $category->multiplier, 2),
                'trip_id' => $item['trip_id'],
                'tariff_id' => $item['tariff_id'],
                'user_id' => Auth::id(),
                'payment_id' => $payment->id,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('tickets.index')->with('success', 'Maksājums veiksmīgs! Biļetes ir pieejamas jūsu kontā.');
    }

    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'Maksājums tika atcelts.');
    }
}