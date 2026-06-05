<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::withTrashed()
            ->whereHas('user', fn($q) => $q->whereNull('deleted_at'))
            ->with(['user', 'trip.tripPlan.route', 'tariff'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(string $id)
    {
        $ticket = Ticket::withTrashed()
            ->whereHas('user', fn($q) => $q->whereNull('deleted_at'))
            ->with(['user', 'trip.tripPlan.route', 'tariff.fromStop', 'tariff.toStop', 'payment', 'category'])
            ->findOrFail($id);

        return view('admin.tickets.show', compact('ticket'));
    }

    public function destroy(string $id)
    {
        $ticket = Ticket::withTrashed()->findOrFail($id);

        if ($ticket->trashed()) {
            return back()->with('error', 'Biļete jau ir dzēsta.');
        }

        $ticket->delete();

        return back()->with('success', 'Biļete dzēsta.');
    }

    public function restore(string $id)
    {
        $ticket = Ticket::withTrashed()->findOrFail($id);

        if (!$ticket->trashed()) {
            return back()->with('error', 'Biļete nav dzēsta.');
        }

        $ticket->restore();

        return back()->with('success', 'Biļete atjaunota.');
    }
}