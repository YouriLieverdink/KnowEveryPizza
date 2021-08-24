<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
     * Relation to the Product model.
     * 
     * @return App\Model\Product
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
