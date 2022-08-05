<?php

namespace App\Http\Controllers;

use App\Product; //para usar eloquent hay que llamar al modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //para usar query builder

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // usando eloquent con el modelo
        //$products = DB::table('products')->get(); usando query builder - no recomendable

        return view('products.index')->with([
            'products' => $products,
        ]);
    }
    public function create()
    {
        return view('products.create');
    }
    public function store()
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];

        request()->validate($rules);

        // $product = Product::create([
        // 'title' => request()->title,
        // 'description' => request()->description,
        //  'price' => request()->price,
        // 'stock' => request()->stock,
        // 'status' => request()->status,
        // ]); // forma vieja

        if (request()->status == 'available' && request()->stock == 0) {

            //session()->flash('error', 'If available must have stock'); // esta linea no hace falta porque agregamos el error con wihtErrors

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors('If available must have stock');
        }

        $product = Product::create(request()->all()); // forma nueva
        //session()->flash('success', "The new product wiht id {$product->id} was created"); lo llamamos por withSuccess


        //return redirect()->back(); // lo manda a la accion anterior
        //return redirect()->action('MainController@index');
        return redirect()
            ->route('products.index') // recomendado, lo redirecciona mediante una ruta
            //->with(['success' => "The new product wiht id {$product->id} was created"]) // seria lo mismo que abajo pero de otra manera
            ->withSuccess("The new product wiht id {$product->id} was created");
    }
    public function show($product)
    {
        //$product = DB::table('products')->where('id', $product)->first(); 
        //igual que la linea de arriba pero resumido
        //$product = DB::table('products')->find($product); usando query builder - no recomendado

        $product = Product::findOrFail($product); // usando eloquent con el modelo, en caso de que no haya, no muestra null

        return view('products.show')->with([
            'product' => $product,
        ]);
    }
    public function edit($product)
    {
        return view('products.edit')->with([
            'product' => Product::findOrFail($product),
        ]);
    }
    public function update($product)
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];

        request()->validate($rules);

        $product = Product::findOrFail($product);

        $product->update(request()->all());

        return redirect()
            ->route('products.index')
            ->withSuccess("The product wiht id {$product->id} was edited");
    }
    public function destroy($product)
    {
        $product = Product::findOrFail($product);

        $product->delete();

        return redirect()
            ->route('products.index')
            ->withSuccess("The product wiht id {$product->id} was deleted");
    }
}
