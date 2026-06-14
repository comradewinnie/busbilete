<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tariff;
use App\Models\TicketCategory;
use App\Models\Trip;
use App\Services\SeatAvailabilityService;

class CartController extends Controller
{
    public function __construct(
        private SeatAvailabilityService $seatService
    ) {}

    public function index()
    {
        $cartData = session('cart', []);
        $items = [];
        $categories = TicketCategory::all();

        foreach ($cartData as $key => $item) {
            $trip = Trip::with(['tripPlan.route', 'bus'])->find($item['trip_id']);
            $tariff = Tariff::with(['fromStop', 'toStop'])->find($item['tariff_id']);
            $category = TicketCategory::find($item['ticket_category_id']);

            if (!$trip || !$tariff || !$category) {
                continue;
            }

            $items[$key] = [
                'trip' => $trip,
                'tariff' => $tariff,
                'category' => $category,
                'price' => round($tariff->price * $category->multiplier, 2),
            ];
        }

        return view('cart.index', compact('items', 'categories'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'tariff_id' => 'required|exists:tariffs,id',
        ]);

        $trip = Trip::with(['tripPlan.route', 'bus'])->findOrFail($request->trip_id);
        $tariff = Tariff::findOrFail($request->tariff_id);

        $availableSeats = $this->seatService->getAvailableSeats(
            $trip,
            $tariff->from_stop_id,
            $tariff->to_stop_id,
            session('cart', [])
        );

        if ($availableSeats <= 0) {
            return back()->with('error', __('cart.no_seats'));
        }

        $defaultCategory = TicketCategory::firstWhere('name', 'Parastā');

        $cart = session('cart', []);
        $cart[uniqid()] = [
            'trip_id' => $request->trip_id,
            'tariff_id' => $request->tariff_id,
            'ticket_category_id' => $defaultCategory->id,
        ];

        session(['cart' => $cart]);

        return redirect()->back()->with('success', __('cart.added'));
    }

    public function updateCategory(Request $request, string $key)
    {
        $request->validate([
            'ticket_category_id' => 'required|exists:ticket_categories,id',
        ]);

        $cart = session('cart', []);

        if (!isset($cart[$key])) {
            return back()->with('error', __('cart.not_found'));
        }

        $cart[$key]['ticket_category_id'] = $request->ticket_category_id;
        session(['cart' => $cart]);

        return back()->with('success', __('cart.category_changed'));
    }

    public function remove(string $key)
    {
        $cart = session('cart', []);
        unset($cart[$key]);
        session(['cart' => $cart]);

        return back()->with('success', __('cart.removed'));
    }
}