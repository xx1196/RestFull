<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\ApiController;
use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sellers = Seller::all();

        return $this->showAll($sellers);

    }

    /**
     * Display the specified resource.
     *
     * @param Seller $seller
     * @return Response
     */
    public function show(Seller $seller)
    {
        return $this->showOne($seller);
    }

}
