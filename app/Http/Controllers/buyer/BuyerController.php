<?php

namespace App\Http\Controllers\buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Response;

class BuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $buyers = Buyer::all();

        return $this->showAll($buyers);

    }

    public function show(Buyer $buyer)
    {
        return $this->showOne($buyer);
    }
}
