<?php

namespace App\Http\Controllers\product;

use App\Category;
use App\Http\Controllers\ApiController;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductCategoryController extends ApiController
{

    public function __construct()
    {
        $this->middleware('client.credentials')
            ->only(
                [
                    'index',
                ]
            );

        $this->middleware('auth:api')
            ->except(
                [
                    'index',
                ]
            );
    }

    /**
     * Display a listing of the resource.
     *
     * @param Product $product
     * @return Response
     */
    public function index(Product $product)
    {
        $categories = $product->categories;

        return $this->showAll($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Product $product
     * @param Category $category
     * @return Response
     */
    public function update(Product $product, Category $category)
    {
        $product->categories()->syncWithoutDetaching([$category->id]);

        return $this->showAll($product->categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product, Category $category)
    {
        if (!$product->categories()->find($category->id)) {
            return $this->errorResponse("La categoria $category->name no pertenece al producto $product->name", 404);
        }
        $product->categories()->detach([$category->id]);
        return $this->showAll($product->categories);
    }
}
