<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteRoute extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'route_id',
        'from_stop_id',
        'to_stop_id',
    ];

    public function route(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    public function fromStop(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Stop::class, 'from_stop_id');
    }

    public function toStop(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Stop::class, 'to_stop_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}