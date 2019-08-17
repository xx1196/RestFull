<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\ApiController;
use App\Product;

class ProductController extends ApiController
{

    public function __construct()
    {
        $this->middleware('client.credentials')
            ->only(
                [
                    'index',
                    'show',
                ]
            );
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $products = Product::all();
        return $this->showAll($products);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function show(Product $product)
    {
        return $this->showOne($product);
    }
}
