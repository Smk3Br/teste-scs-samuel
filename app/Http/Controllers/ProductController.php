<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $model;
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    private function rules()
    {
        return [
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response($this->model->all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        try {
            $this->model->create($request->all());
            return response('Criado com sucesso!', 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->model->find($id);
        if(!$product) {
            return response('Não localizado!', 404);
        }
        return response($product, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $product = $this->model->find($id);
        if(!$product) {
            return response('Não localizado!', 404);
        }

        try {
            $item = $request->all();
            $product->fill($item)->save();
            return response('Atualizado com sucesso!', 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->model->find($id);
        if(!$product) {
            return response('Não localizado!', 404);
        }

        try {
            $product->delete();
            return response('Excluido com sucesso!', 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
