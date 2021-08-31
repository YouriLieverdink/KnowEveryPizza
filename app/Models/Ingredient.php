<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'unit',
    ];

    /**
     * Relation to the Product model.
     * 
     * @return App\Model\Product
     */
    public function products()
    {
        return $this
            ->belongsToMany(Product::class)
            ->withTimestamps()
            ->withPivot('medium', 'italian', 'large', 'family')
            ->as('amounts');
    }
}
