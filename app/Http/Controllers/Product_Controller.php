<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class Product_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'manufacturer' => 'required',
            'desc' => 'required'
        ]);
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if ($product != null) {
            return $product;
        } else {
            return response()->json([
                'No product found'
            ], 404);
        }
    }

    /**
     * Metod för att uppdatera produkt.
     */
    public function update(Request $request, string $id)
    {
        //hitta produkten genomm ID:
        $product = Product::find($id);

        //kontrollera att produkten finns: om så är fallet...
        if ($product != null) {
            //... updateras kursen
            $product->update($request->all());
            //och returneras.
            return $product;
        } else {
            return response()->json([
                'Product not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     * Kolla så att deleten faktiskt fungerar. Den returnerar "ja" men menar "nej" just nu.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product != null) {
            $product->delete(); // Corrected method call
            return response()->json([
                'Product deleted successfully'
            ]);
        } else {
            return response()->json([
                'Product not found'
            ], 404);
        }
    }
    
}
