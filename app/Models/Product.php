<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    /**
     * Relation to the Category model.
     * 
     * @return App\Models\Category
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    /**
     * Relation to the Ingredient model.
     * 
     * @return App\Models\Ingredient
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withTimestamps();
    }
}
