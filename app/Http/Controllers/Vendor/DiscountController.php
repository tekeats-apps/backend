<?php

namespace App\Http\Controllers\Vendor;

use App\Enums\Vendor\DiscountTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\DiscountRequest;
use App\Models\Vendor\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vendor.modules.discounts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $discountTypes = DiscountTypeEnum::values();
        return view('vendor.modules.discounts.create', compact('discountTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountRequest $request)
    {
        try {
            Discount::create($request->validated());
            return redirect()->route('vendor.discounts.list')->with('success', 'Discount created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('vendor.discounts.list')->with('error', 'Failed to create discount: ' . $e->getMessage());
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
