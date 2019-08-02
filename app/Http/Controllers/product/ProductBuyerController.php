<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\ApiController;
use App\Product;
use Illuminate\Http\Response;

class ProductBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Product $product
     * @return Response
     */
    public function index(Product $product)
    {
        $buyers = $product
            ->transactions()
            ->with('buyer')
            ->get()
            ->pluck('buyer')
            ->unique('id')
            ->values();

        return $this->showAll($buyers);
    }
}
