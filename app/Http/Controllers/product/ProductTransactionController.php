<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\ApiController;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductTransactionController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Product $product
     * @return Response
     */
    public function index(Product $product)
    {
        $transactions = $product->transactions;

        return $this->showAll($transactions);
    }

}
