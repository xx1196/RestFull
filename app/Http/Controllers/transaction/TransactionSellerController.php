<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\ApiController;
use App\Transaction;
use Illuminate\Http\Response;

class TransactionSellerController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function index(Transaction $transaction)
    {
        $seller = $transaction->product->seller;

        return $this->showOne($seller);
    }
}
