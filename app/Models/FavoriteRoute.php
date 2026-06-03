<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteRoute extends Model
{
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'route_id',
        'user_id',
    ];
}