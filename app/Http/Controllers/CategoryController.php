<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return Response::json([
            'message' => null,
            'data' => CategoryResource::collection($categories),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        // Check whether a photo has been provided.
        if (key_exists('photo', $validated)) {

            // Store the file and update it's path.
            $path = Storage::putFile('categories', $request->file('photo'));

            $validated['photo'] = $path;
        }

        // Create the category.
        $category = Category::create($validated);

        // Sync the products.
        if (key_exists('products', $validated)) {

            $category->products()->sync($validated['products']);
        }

        return Response::json([
            'message' => 'The category has been stored.',
            'data' => new CategoryResource($category),
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
        $category = Category::firstWhere('id', $id);

        // Check whether the category has been found.
        if ($category === null) {

            return Response::json([
                'message' => 'The category has not been found.',
                'data' => null,
            ], 404);
        }

        return Response::json([
            'message' => null,
            'data' => new CategoryResource($category),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::firstWhere('id', $id);

        // Check whether the category has been found.
        if ($category === null) {

            return Response::json([
                'message' => 'The category has not been found.',
                'data' => null,
            ], 404);
        }

        $validated = $request->validated();

        // Check whether a photo has been provided.
        if (key_exists('photo', $validated)) {

            // Store the file and update it's path.
            $path = Storage::putFile('categories', $request->file('photo'));

            $validated['photo'] = $path;
        }

        // Update the category.
        $category->update($validated);

        // Sync the products.
        if (key_exists('products', $validated)) {

            $category->products()->sync($validated['products']);
        }

        return Response::json([
            'message' => 'The category has been updated.',
            'data' => new CategoryResource($category),
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
        $category = Category::firstWhere('id', $id);

        // Check whether the category has been found.
        if ($category === null) {

            return Response::json([
                'message' => 'The category has not been found.',
                'data' => null,
            ], 404);
        }

        // Delete the photo and the category.
        Storage::delete($category->path);

        $category->delete();

        return Response::noContent();
    }
}
