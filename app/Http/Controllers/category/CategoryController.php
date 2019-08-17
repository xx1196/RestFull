<?php

namespace App\Http\Controllers\category;

use App\Category;
use App\Http\Controllers\ApiController;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends ApiController
{

    public function __construct()
    {
        $this->middleware('client.credential')
            ->only(
                [
                    'index',
                    'show',
                ]
            );

        $this->middleware('auth:api')
            ->except(
                [
                    'index',
                    'show',
                ]
            );
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $categories = Category::all();

        return $this->showAll($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->all());

        return $this->showOne($category, "La categoría $category->name se ha creado con éxito", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return void
     */
    public function show(Category $category)
    {
        return $this->showOne($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdateRequest $request
     * @param Category $category
     * @return void
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->fill(
            $request->only(
                [
                    'name',
                    'description'
                ]
            )
        );

        if ($category->isClean()) {
            return $this->errorResponse('Debe especificar un valor diferente para actualizar'
                , 422);
        }

        $category->save();

        return $this->showOne($category, "La categoria $category->name ha sido actualizado");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return void
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $this->showOne($category, "La categoria $category->name se ha eliminado con éxito");
    }
}
