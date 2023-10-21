<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Models\Vendor\Coupon;
use App\Enums\Vendor\CouponType;
use App\Enums\Vendor\CouponOption;
use App\Http\Controllers\Controller;
use App\Enums\Vendor\CouponAmountType;
use App\Http\Requests\Vendor\CouponRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vendor.modules.coupons.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $couponTypes = CouponType::cases();
        $couponOptions = CouponOption::cases();
        $couponAmountTypes = CouponAmountType::cases();
        return view('vendor.modules.coupons.create', compact('couponTypes', 'couponOptions', 'couponAmountTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        try {
            Coupon::create(array_merge($request->validated(), ['vendor_id' => 'ef345c96-0d9d-4847-88c2-d8b168f61a25']));
            return redirect()->route('vendor.coupons.list')->with('success', 'Coupon created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('vendor.coupons.list')->with('error', 'Failed to create coupon: ' . $e->getMessage());
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
