<?php

namespace App\Http\Controllers\buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Response;

class BuyerCategoryController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Buyer $buyer
     * @return Response
     */
    public function index(Buyer $buyer)
    {
        $categories = $buyer
            ->transactions()
            ->with('product.categories')
            ->get()
            ->pluck('product.categories')
            ->collapse()
            ->unique('id')
            ->values();

        return $this->showAll($categories);
    }
}
