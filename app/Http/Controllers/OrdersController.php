<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Orders;
use App\Models\ProductDetail;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $userOrders = Orders::where('user_id', $id)->get();
        return response()->json($userOrders);
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
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'total' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'details' => 'required|array',
            'details.*.id_product' => 'required',
            'details.*.quantity' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $orderData = $validator->validated();  // Get validated data
        
        $order = Orders::create([
            'user_id' => $orderData['user_id'],
            'total' => $orderData['total']
        ]);
        
        foreach ($orderData['details'] as $detail) {
            $productDetail = new ProductDetail([
                'id_product' => $detail['id_product'],
                'quantity' => $detail['quantity']
            ]);
        
            $order->details()->save($productDetail);  // Assuming you have a relationship method named 'details'
        }
        
        return response()->json([
            'message' => 'Orden Registrada Exitosamente!',
            'order' => $order
        ], 201);
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
