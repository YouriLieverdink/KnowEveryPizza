<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
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
            'unit' => $this->unit,
        ];

        /* Add the amounts of the sizes */
        if ($this->amounts !== null) {

            $data['amounts'] = $this->amounts->only('medium', 'italian', 'large', 'family');
        }

        return $data;
    }
}
