<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            // Carga el contenido del archivo JSON
            $jsonPath = public_path('../data.json');
            $jsonData = File::get($jsonPath);
    
            // Decodifica el JSON
            $orders = json_decode($jsonData);
    
            return response()->json($orders);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Carga el contenido del archivo JSON
        $jsonPath = public_path('../data.json');
        $jsonData = File::get($jsonPath);

        // Decodifica el JSON
        $jsonArray = json_decode($jsonData, true);

        // Busca el producto en el arreglo JSON por su ID
        $product = null;
        foreach ($jsonArray['data'] as $item) {
            if ($item['id'] == $id) {
                $product = $item;
                break;
            }
        }

        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
