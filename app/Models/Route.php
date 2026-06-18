<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'number',
        'name',
        'distance_km',
        'carrier_registration_number',
    ];

    public function carrier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Carrier::class, 'carrier_registration_number', 'registration_number');
    }

    public function stops(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Stop::class, 'route_stops')
            ->withPivot('sequence_number')
            ->orderByPivot('sequence_number');
    }

    public function tripPlans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TripPlan::class);
    }

    public function tariffs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Tariff::class);
    }
}