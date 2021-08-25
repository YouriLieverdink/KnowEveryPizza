<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all the products.
        $products = Product::all();

        return Response::json([
            'message' => null,
            'data' => ProductResource::collection($products),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        // Check whether a photo has been provided.
        if (key_exists('photo', $validated)) {

            // Store the file and update it's path.
            $path = Storage::putFile('products', $request->file('photo'));

            $validated['photo'] = $path;
        }

        // Create the product.
        $product = Product::create($validated);

        // Sync the ingredients.
        if (key_exists('ingredients', $validated)) {

            $product->ingredients()->sync($validated['ingredients']);
        }

        return Response::json([
            'message' => 'The product has been stored.',
            'data' => new ProductResource($product),
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
        $product = Product::firstWhere('id', $id);

        // Check whether the product has been found.
        if ($product === null) {

            return Response::json([
                'message' => 'The product has not been found.',
                'data' => null,
            ], 404);
        }

        return Response::json([
            'message' => null,
            'data' => new ProductResource($product),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::firstWhere('id', $id);

        // Check whether the product has been found.
        if ($product === null) {

            return Response::json([
                'message' => 'The product has not been found.',
                'data' => null,
            ], 404);
        }

        $validated = $request->validated();

        // Check whether a photo has been provided.
        if (key_exists('photo', $validated)) {

            // Store the file and update it's path.
            $path = Storage::putFile('products', $request->file('photo'));

            $validated['photo'] = $path;
        }

        // Update the product.
        $product->update($validated);

        // Sync the ingredients.
        if (key_exists('ingredients', $validated)) {

            $product->ingredients()->sync($validated['ingredients']);
        }

        return Response::json([
            'message' => 'The product has been updated.',
            'data' => new ProductResource($product),
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
        $product = Product::firstWhere('id', $id);

        // Check whether the product has been found.
        if ($product === null) {

            return Response::json([
                'message' => 'The product has not been found.',
                'data' => null,
            ], 404);
        }

        $product->delete();

        return Response::noContent();
    }
}
