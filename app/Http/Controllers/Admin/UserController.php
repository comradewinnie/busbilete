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
            return back()->with('error', __('admin_users.already_deleted'));
        }

        $user->delete();

        return back()->with('success', __('admin_users.is_deleted'));
    }

    public function restore(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if (!$user->trashed()) {
            return back()->with('error', __('admin_users.not_deleted'));
        }

        $user->restore();

        return back()->with('success', __('admin_users.restored'));
    }
}