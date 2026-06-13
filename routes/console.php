<?php

use App\Models\User;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    User::onlyTrashed()
        ->where('deleted_at', '<=', now()->subDays(30))
        ->forceDelete();
})->daily();