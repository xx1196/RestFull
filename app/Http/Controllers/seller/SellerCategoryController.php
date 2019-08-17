<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\ApiController;
use App\Seller;

class SellerCategoryController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Seller $seller)
    {
        $categories = $seller
            ->products()
            ->get()
            ->pluck('categories')
            ->collapse()
            ->unique('id')
            ->values();

        return $this->showAll($categories);
    }
}
