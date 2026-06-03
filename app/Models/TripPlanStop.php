<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripPlanStop extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'trip_plan_id',
        'stop_id',
        'departure_time',
    ];

    public function tripPlan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TripPlan::class);
    }

    public function stop(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Stop::class);
    }
}