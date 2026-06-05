<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()
            ->orderBy('deleted_at')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function show(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    public function destroy(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if ($user->trashed()) {
            return back()->with('error', 'Lietotājs jau ir dzēsts.');
        }

        $user->delete();

        return back()->with('success', 'Lietotājs dzēsts.');
    }

    public function restore(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if (!$user->trashed()) {
            return back()->with('error', 'Lietotājs nav dzēsts.');
        }

        $user->restore();

        return back()->with('success', 'Lietotājs atjaunots.');
    }
}