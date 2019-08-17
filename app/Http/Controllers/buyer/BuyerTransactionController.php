<?php

namespace App\Http\Controllers\buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Response;

class BuyerTransactionController extends ApiController
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
        $transactions = $buyer->transactions;

        return $this->showAll($transactions);
    }
}
