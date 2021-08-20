<?php

namespace App\Traits;

trait Children
{
    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->forceFill(['type' => static::class]);
        });
    }

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted()
    {
        static::addGlobalScope(static::class, function ($builder) {
            $builder->where('type', static::class);
        });
    }
}
