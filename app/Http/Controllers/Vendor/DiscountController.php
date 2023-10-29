<?php

namespace App\Http\Controllers\Vendor;

use App\Enums\Vendor\DiscountType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\DiscountRequest;
use App\Models\Vendor\Category;
use App\Models\Vendor\Discount;
use App\Models\Vendor\Product;

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
        $discountTypes = DiscountType::cases();
        $categories = Category::all();
        $products = Product::all();
        return view('vendor.modules.discounts.create', compact('discountTypes', 'categories', 'products'));
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
        try {
            $discount = Discount::findOrFail($id);
            return view('vendor.modules.discounts.show', compact('discount'));
        } catch (\Exception $e) {
            return redirect()->route('vendor.discounts.list')->with('error', 'Failed to find discount: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $discountTypes = DiscountType::cases();
            $categories = Category::all();
            $products = Product::all();
            $discount = Discount::with(['categories', 'products'])->findOrFail($id);
            return view('vendor.modules.discounts.edit', compact('discount', 'discountTypes', 'categories', 'products'));
        } catch (\Exception $e) {
            return redirect()->route('vendor.discounts.list')->with('error', 'Failed to find discount: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountRequest $request, string $id)
    {
        try {
            Discount::findOrFail($id)->update($request->validated());
            return redirect()->route('vendor.discounts.list')->with('success', 'Discount updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('vendor.discounts.list')->with('error', 'Failed to update discount: ' . $e->getMessage());
        }
    }
}
