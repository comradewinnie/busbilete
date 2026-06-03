<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $primaryKey = 'registration_number';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'registration_number',
        'name',
        'phone',
        'email',
    ];

    public function routes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Route::class, 'carrier_registration_number', 'registration_number');
    }
}