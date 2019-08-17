<?php

namespace App\Http\Controllers\category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Response;

class CategoryProductController extends ApiController
{

public function __construct()
{
    $this->middleware('client.credential')
        ->only(
            [
                'index',
            ]
        );
}

    /**
     * Display a listing of the resource.
     *
     * @param Category $category
     * @return Response
     */
    public function index(Category $category)
    {
        $products = $category->products;

        return $this->showAll($products);
    }
}
