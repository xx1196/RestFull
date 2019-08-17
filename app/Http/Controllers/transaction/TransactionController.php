<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\ApiController;
use App\Transaction;
class TransactionController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $transactions = Transaction::all();

        return $this->showAll($transactions);
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return void
     */
    public function show(Transaction $transaction)
    {
        return $this->showOne($transaction);
    }

}
