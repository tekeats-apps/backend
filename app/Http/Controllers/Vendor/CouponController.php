<?php

namespace App\Http\Controllers\Vendor;

use App\Enums\Vendor\CouponActive;
use App\Models\Vendor\Coupon;
use App\Http\Controllers\Controller;
use App\Enums\Vendor\CouponAmountType;
use App\Enums\Vendor\CouponIsUnlimited;
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
        $couponAmountTypes = CouponAmountType::cases();
        return view('vendor.modules.coupons.create', compact('couponAmountTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        try {
            $coupon = $this->validateCoupon($request->validated());
            Coupon::create($coupon);
            return redirect()->route('vendor.coupons.list')->with('success', 'Coupon created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('vendor.coupons.list')->with('error', 'Failed to create coupon: ' . $e->getMessage());
        }
    }

    /**
     * Validate 'is_unlimited' & 'active' fields
     * before create or update.
     */
    private function validateCoupon($request)
    {
        $coupon = $request;
        if (isset($request['is_unlimited'])) {
            $coupon = array_merge($coupon, ['is_unlimited' => CouponIsUnlimited::ACTIVE->value, 'allowed_time' => null]);
        } else {
            $coupon = array_merge($coupon, ['is_unlimited' => CouponIsUnlimited::INACTIVE->value]);
        }
        if (isset($request['active'])) {
            $coupon = array_merge($coupon, ['active' => CouponActive::ACTIVE->value]);
        } else {
            $coupon = array_merge($coupon, ['active' => CouponActive::INACTIVE->value]);
        }

        return $coupon;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $couponAmountTypes = CouponAmountType::cases();
            $coupon = Coupon::findOrFail($id);
            return view('vendor.modules.coupons.edit', compact('coupon', 'couponAmountTypes'));
        } catch (\Exception $e) {
            return redirect()->route('vendor.coupons.list')->with('error', 'Failed to find coupon: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, string $id)
    {
        try {
            $coupon = $this->validateCoupon($request->validated());
            Coupon::findOrFail($id)->update($coupon);
            return redirect()->route('vendor.coupons.list')->with('success', 'Coupon updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('vendor.coupons.list')->with('error', 'Failed to update coupon: ' . $e->getMessage());
        }
    }
}
