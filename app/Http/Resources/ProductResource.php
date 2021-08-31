<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'ingredients' => [],
        ];

        foreach ($this->ingredients as $ingredient) {

            array_push($data['ingredients'], new IngredientResource($ingredient),);
        }

        return $data;
    }
}
