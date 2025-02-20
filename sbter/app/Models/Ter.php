<?php

namespace App\Models;

use App\Events\TerCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ter extends Model
{
    protected $fillable = [
        'message',
    ];

    protected $dispatchesEvents = [
        'created' => TerCreated::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
