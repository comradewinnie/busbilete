<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountRestoreController extends Controller
{
    public function show()
    {
        $userId = session('restore_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::onlyTrashed()->findOrFail($userId);

        $finalDeleteDate = $user->deleted_at->addDays(30);
        $hoursLeft = now()->diffInHours($finalDeleteDate, false);
        $daysLeft = $hoursLeft > 0 ? (int) ceil($hoursLeft / 24) : 0;

        return view('auth.restore_account', compact('user', 'daysLeft'));
    }

    public function restore()
    {
        $userId = session('restore_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::onlyTrashed()->findOrFail($userId);
        $user->restore(); 
        session()->forget('restore_user_id');
        
        Auth::login($user);
        return redirect()->route('home')->with('success', 'Konts ir atjaunots.');
    }

    public function cancel()
    {
        session()->forget('restore_user_id');
        return redirect()->route('login')->with('error', 'Konts netika atjaunots.');
    }
}
