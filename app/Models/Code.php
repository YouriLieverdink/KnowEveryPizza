<?php

namespace App\Models;

use App\Traits\Parents;
use App\Events\CodeCreatedEvent;
use App\Events\CodeCreatingEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Code extends Model
{
    use HasFactory, Parents;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'code',
        'expires_at',
    ];

    /**
     * The event map for the model.
     *
     * Allows for object-based events for native Eloquent events.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => CodeCreatingEvent::class,
        'created' => CodeCreatedEvent::class,
    ];
}
