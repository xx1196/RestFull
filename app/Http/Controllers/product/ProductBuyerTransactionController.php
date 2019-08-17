<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ProductBuyerTransactionStoreRequest;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductBuyerTransactionStoreRequest $request
     * @param Product $product
     * @param User $buyer
     * @return void
     */
    public function store(ProductBuyerTransactionStoreRequest $request, Product $product, User $buyer)
    {
        if ($buyer->id === $product->seller_id)
            return $this->errorResponse("El comprador debe ser diferente al vendedor", 409);

        if ($buyer->isVerified())
            return $this->errorResponse("El comprador debe ser verificado", 409);

        if ($product->seller->isVerified())
            return $this->errorResponse("El vendedor debe ser verificado", 409);

        if (!$product->isAvailable())
            return $this->errorResponse("El producto $product->name no esta disponible", 409);

        if ($product->quantity < $request->quantity)
            return $this->errorResponse("El stock del producto es de $product->quantity no es suficiente para vender $request->quantity", 409);

        return DB::transaction(function () use ($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);

            return $this->showOne($transaction, 201);
        });


    }

}
