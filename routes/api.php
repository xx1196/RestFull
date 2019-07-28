<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('buyers', 'buyer\BuyerController',
    [
        'only' => ['index', 'show']
    ]
);

Route::resource('categories', 'category\CategoryController',
    [
        'except' => ['create', 'edit']
    ]
);

Route::resource('products', 'product\ProductController',
    [
        'only' => ['index', 'show']
    ]
);

Route::resource('transactions', 'transaction\TransactionController',
    [
        'only' => ['index', 'show']
    ]
);

Route::resource('transactions.categories', 'transaction\TransactionCategoryController',
    [
        'only' => ['index']
    ]
);

Route::resource('transactions.sellers', 'transaction\TransactionSellerController',
    [
        'only' => ['index']
    ]
);

Route::resource('sellers', 'seller\SellerController',
    [
        'only' => ['index', 'show']
    ]
);

Route::resource('users', 'user\UserController',
    [
        'except' => ['create', 'edit']
    ]
);