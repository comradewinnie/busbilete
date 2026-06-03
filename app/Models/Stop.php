<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];

    public function routes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Route::class, 'route_stops')
            ->withPivot('sequence_number')
            ->orderByPivot('sequence_number');
    }

    public function tripPlanStops(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TripPlanStop::class);
    }

    public function tariffsFrom(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Tariff::class, 'from_stop_id');
    }

    public function tariffsTo(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Tariff::class, 'to_stop_id');
    }
}