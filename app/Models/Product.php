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
        'photo',
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
        return $this
            ->belongsToMany(Ingredient::class)
            ->withTimestamps()
            ->withPivot('medium', 'italian', 'large', 'family')
            ->as('amounts');
    }

    /**
     * Sync the provided ingredients.
     * 
     * @param array $ingredients
     * @return void
     */
    public function syncIngredients(array $ingredients)
    {
        // Create the data object used in the sync method.
        foreach ($ingredients as $ingredient) {

            // The available sizes.
            $sizes = ['medium', 'italian', 'large', 'family'];

            foreach ($sizes as $size) {

                // Only update the sizes who have received a value.
                if (key_exists($size, $ingredient)) {

                    $data[$ingredient['id']][$size] = $ingredient[$size];
                }
            }
        }

        // Sync the data.
        $this->ingredients()->sync($data);
    }
}
