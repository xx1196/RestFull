<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\ApiController;
use App\Seller;
use Illuminate\Http\Response;

class SellerTransactionController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Seller $seller
     * @return Response
     */
    public function index(Seller $seller)
    {
        $transactions = $seller
            ->products()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();

        return $this->showAll($transactions);
    }
}
