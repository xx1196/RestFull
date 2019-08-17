<?php

namespace App\Http\Controllers\buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Response;

class BuyerSellerController extends ApiController
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
        $sellers = $buyer
            ->transactions()
            ->with('product.seller')
            ->get()
            ->pluck('product.seller')
            ->unique('id')
            ->values();

        return $this->showAll($sellers);
    }

}
