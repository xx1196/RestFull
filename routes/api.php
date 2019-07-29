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

Route::resource('buyers.transactions', 'buyer\BuyerTransactionController',
    [
        'only' => ['index']
    ]
);

Route::resource('buyers.products', 'buyer\BuyerProductController',
    [
        'only' => ['index']
    ]
);

Route::resource('buyers.sellers', 'buyer\BuyerSellerController',
    [
        'only' => ['index']
    ]
);

Route::resource('buyers.categories', 'buyer\BuyerCategoryController',
    [
        'only' => ['index']
    ]
);

Route::resource('categories', 'category\CategoryController',
    [
        'except' => ['create', 'edit']
    ]
);

Route::resource('categories.products', 'category\CategoryProductController',
    [
        'only' => ['index']
    ]
);

Route::resource('categories.sellers', 'category\CategorySellerController',
    [
        'only' => ['index']
    ]
);

Route::resource('categories.transactions', 'category\CategoryTransactionController',
    [
        'only' => ['index']
    ]
);

Route::resource('categories.buyers', 'category\CategoryBuyerController',
    [
        'only' => ['index']
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