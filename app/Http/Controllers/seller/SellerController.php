<?php

namespace App\Http\Controllers\seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sellers = Seller::has('products')->get();

        return response()->json([
            'data' => $sellers,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $seller = Seller::has('products')->findOrFail($id);

        return response()->json([
            'data' => $seller,
        ], 200);
    }

}
