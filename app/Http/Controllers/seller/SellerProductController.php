<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use App\Seller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Seller $seller
     * @return Response
     */
    public function index(Seller $seller)
    {
        $products = $seller->products;

        return $this->showAll($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(ProductStoreRequest $request, User $seller)
    {
        $data = $request->all();
        $data['status'] = Product::PRODUCT_NOT_AVAILABLE;
        $data['image'] = '1.jpg';
        $data['seller_id'] = $seller->id;

        $product = Product::create($data);

        return $this->showOne($product, "El producto $product->name se ha creado con éxito al vendedor $seller->name", 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param Seller $seller
     * @return void
     */
    public function update(ProductUpdateRequest $request, Seller $seller, Product $product)
    {
        $this->verifySeller($seller, $product);

        $product->fill(
            $request->only(
                [
                    'name',
                    'description',
                    'quantity',
                ]
            )
        );

        if ($request->has('status')) {
            $product->status = $request->status;

            if ($product->isAvailable() && $product->categories()->count()) {
                return $this->errorResponse("El producto $product->name debe tener una categoriaa la que pertenezca", 409);
            }
        }

        if ($product->isClean())
            return $this->errorResponse("Se debe especificar un valor diferente para poder actualizar", 422);

        $product->save();

        return $this->showOne($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Seller $seller
     * @param Product $product
     * @return Response
     * @throws Exception
     */
    public function destroy(Seller $seller, Product $product)
    {
        $this->verifySeller($seller, $product);

        $product->delete();

        return $this->showOne($product, "Se ha eliminado el producto $product->name");

    }

    protected function verifySeller(Seller $seller, Product $product)
    {
        if ($seller->id != $product->seller_id) {
            throw new HttpException(422, "El vendedor $seller->name no es el vendedor real del producto $product->name");
        }
    }
}
