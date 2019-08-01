<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\ApiController;
use App\Seller;

class SellerTransactionController extends ApiController
{
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
