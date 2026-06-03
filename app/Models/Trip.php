<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'date',
        'status',
        'bus_id',
        'trip_plan_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function tripPlan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TripPlan::class);
    }

    public function bus(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }

    public function tickets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}