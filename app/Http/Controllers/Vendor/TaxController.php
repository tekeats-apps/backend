<?php

namespace App\Http\Controllers\Vendor;

use App\Enums\Vendor\Tax\TypeEnum;
use App\Models\Vendor\Tax;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\TaxRequest;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vendor.modules.taxes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $taxTypes = TypeEnum::values();
        return view('vendor.modules.taxes.create', compact('taxTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaxRequest $request)
    {
        try {
            Tax::create($request->validated());
            return redirect()->route('vendor.taxes.list')->with('success', 'Tax created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('vendor.taxes.list')->with('error', 'Failed to create tax: ' . $e->getMessage());
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
        try {
            $taxTypes = TypeEnum::values();
            $tax = Tax::findOrFail($id);
            return view('vendor.modules.taxes.edit', compact('tax', 'taxTypes'));
        } catch (\Exception $e) {
            return redirect()->route('vendor.taxes.list')->with('error', 'Failed to find tax: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaxRequest $request, string $id)
    {
        try {
            Tax::findOrFail($id)->update($request->validated());
            return redirect()->route('vendor.taxes.list')->with('success', 'Tax updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('vendor.taxes.list')->with('error', 'Failed to update tax: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
