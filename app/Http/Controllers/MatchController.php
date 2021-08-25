<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Match\NewRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Response;

class MatchController extends Controller
{
    /**
     * Returns a new random product.
     * 
     * @param App\Http\Requests\Match\NewRequest $request
     * @return Illuminate\Support\Facades\Response
     */
    public function new(NewRequest $request)
    {
        $validated = $request->validated();

        // Retrieve the products.
        $products = Product::whereNotIn('products.id', $validated['exclude'])
            ->whereHas('categories', function ($query) use ($validated) {
                $query->whereIn('categories.id', $validated['categories']);
            });

        // Retrieve a random product.
        $product = $products->inRandomOrder()->first();

        // Check whether a product has been found.
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
}
