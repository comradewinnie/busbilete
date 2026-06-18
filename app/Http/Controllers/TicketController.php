<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())
            ->with(['trip.tripPlan.stops', 'tariff.fromStop', 'tariff.toStop', 'category', 'trip.tripPlan.route'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $ticket->load(['trip.tripPlan.route', 'trip.tripPlan.stops', 'tariff.fromStop', 'tariff.toStop', 'category']);

        return view('tickets.show', compact('ticket'));
    }
}