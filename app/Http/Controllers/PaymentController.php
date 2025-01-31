<?php

namespace App\Http\Controllers;
use App\Models\Sell;

use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function confirmPayment(Request $request)
    {
        $orderId = $request->order_id;

        if (!$orderId) {
            return redirect()->back()->with('error', 'Invalid order ID');
        }

        // Simulate Payment Success (Replace this with actual payment logic)
        $sell = Sell::findOrFail($orderId);
        $sell->status = 'paid';
        $sell->save();

        return redirect()->back()->with([
            'payment_success' => true,
            'order_id' => $orderId
        ]);
    }    
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
        //
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
