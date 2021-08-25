<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\IngredientResource;
use App\Http\Requests\Ingredient\StoreIngredientRequest;
use App\Http\Requests\Ingredient\UpdateIngredientRequest;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all the ingredients.
        $ingredients = Ingredient::all();

        return Response::json([
            'message' => null,
            'data' => IngredientResource::collection($ingredients),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIngredientRequest $request)
    {
        $validated = $request->validated();

        // Store the ingredient.
        $ingredient = Ingredient::create($validated);

        return Response::json([
            'message' => 'The ingredient has been stored.',
            'data' => new IngredientResource($ingredient),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingredient = Ingredient::firstWhere('id', $id);

        // Check whether the ingredient has been found.
        if ($ingredient === null) {

            return Response::json([
                'message' => 'The ingredient has not been found.',
                'data' => null,
            ], 404);
        }

        return Response::json([
            'message' => null,
            'data' => new IngredientResource($ingredient),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIngredientRequest $request, $id)
    {
        $ingredient = Ingredient::firstWhere('id', $id);

        // Check whether the ingredient has been found.
        if ($ingredient === null) {

            return Response::json([
                'message' => 'The ingredient has not been found.',
                'data' => null,
            ], 404);
        }

        $validated = $request->validated();

        // Update the ingredient.
        $ingredient->update($validated);

        return Response::json([
            'message' => 'The ingredient has been updated.',
            'data' => new IngredientResource($ingredient),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient = Ingredient::firstWhere('id', $id);

        // Check whether the ingredient has been found.
        if ($ingredient === null) {

            return Response::json([
                'message' => 'The ingredient has not been found.',
                'data' => null,
            ], 404);
        }

        $ingredient->delete();

        return Response::noContent();
    }
}
