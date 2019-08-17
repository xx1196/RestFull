<?php

namespace App\Http\Controllers\category;

use App\Category;
use App\Http\Controllers\ApiController;

class CategoryTransactionController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Category $category
     * @return void
     */
    public function index(Category $category)
    {
        $transactions = $category
            ->products()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->unique('id')
            ->values();

        return $this->showAll($transactions);
    }

}
