<?php

namespace App\Http\Controllers\Panel;

use App\PanelProduct; //para usar eloquent hay que llamar al modelo
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB; //para usar query builder

class ProductController extends Controller
{
    public function index()
    {
        //$products = Product::all(); // usando eloquent con el modelo
        //$products = DB::table('products')->get(); usando query builder - no recomendable

        return view('products.index')->with([
            'products' => PanelProduct::without('images')->get(),
        ]);
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(ProductRequest $request)
    {
        //$rules = [
          //  'title' => ['required', 'max:255'],
            //'description' => ['required', 'max:1000'],
            //'price' => ['required', 'min:1'],
            ///'stock' => ['required', 'min:0'],
            //'status' => ['required', 'in:available,unavailable'],
        //];

        //request()->validate($rules); $rules y request son llamadas desde el parametro ProductRequest $request en la funcion

        // $product = Product::create([
        // 'title' => request()->title,
        // 'description' => request()->description,
        //  'price' => request()->price,
        // 'stock' => request()->stock,
        // 'status' => request()->status,
        // ]); // forma vieja

        $product = PanelProduct::create($request->validated($request)); // forma nueva
        //session()->flash('success', "The new product wiht id {$product->id} was created"); lo llamamos por withSuccess


        //return redirect()->back(); // lo manda a la accion anterior
        //return redirect()->action('MainController@index');
        return redirect()
            ->route('products.index') // recomendado, lo redirecciona mediante una ruta
            //->with(['success' => "The new product wiht id {$product->id} was created"]) // seria lo mismo que abajo pero de otra manera
            ->withSuccess("The new product wiht id {$product->id} was created");
    }
    public function show(PanelProduct $product)
    {
        //$product = DB::table('products')->where('id', $product)->first(); 
        //igual que la linea de arriba pero resumido
        //$product = DB::table('products')->find($product); usando query builder - no recomendado

        //$product = Product::findOrFail($product); // usando eloquent con el modelo, en caso de que no haya, no muestra null // esta linea no se usa porque llamamos al modelo Product como parametro de la funcion

        return view('products.show')->with([
            'product' => $product,
        ]);
    }
    public function edit(PanelProduct $product)
    {
        return view('products.edit')->with([
            'product' => $product,
        ]);
    }
    public function update(ProductRequest $request, PanelProduct $product)
    {
        //$rules = [
          //  'title' => ['required', 'max:255'],
            //'description' => ['required', 'max:1000'],
            //'price' => ['required', 'min:1'],
            //'stock' => ['required', 'min:0'],
            //'status' => ['required', 'in:available,unavailable'],
        //];

        //request()->validate($rules); $rules y request son llamadas desde el parametro ProductRequest $request en la funcion

        //$product = Product::findOrFail($product); linea innecesaria si agregamos como parametro el modelo Product en la funcion

        $product->update(request()->validated($request));

        return redirect()
            ->route('products.index')
            ->withSuccess("The product wiht id {$product->id} was edited");
    }
    public function destroy(PanelProduct $product)
    {
        //$product = Product::findOrFail($product); linea innecesaria si agregamos como parametro el modelo Product en la funcion

        $product->delete();

        return redirect()
            ->route('products.index')
            ->withSuccess("The product wiht id {$product->id} was deleted");
    }
}
