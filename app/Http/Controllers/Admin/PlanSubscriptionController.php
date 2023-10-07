<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanSubscriptionRequest;
use App\Models\PlanSubscription;
use Illuminate\Http\Request;

class PlanSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.modules.plan-subscriptions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.plan-subscriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanSubscriptionRequest $request)
    {
        try {
            PlanSubscription::create($request->validated());
            return redirect()->route('admin.plans.subscriptions.list')->with('success', 'Plan subscription created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.plans.subscriptions.list')->with('error', 'Failed to create plan subscription: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        try {
            $planSubscription = PlanSubscription::findOrFail($uuid);
            return view('admin.modules.plan-subscriptions.show', compact('planSubscription'));
        } catch (\Exception $e) {
            return redirect()->route('admin.plans.subscriptions.list')->with('error', 'Failed to get plan subscription: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        try {
            $planSubscription = PlanSubscription::findOrFail($uuid);
            return view('admin.modules.plan-subscriptions.edit', compact('planSubscription'));
        } catch (\Exception $e) {
            return redirect()->route('admin.plans.subscriptions.list')->with('error', 'Failed to get plan subscription: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanSubscriptionRequest $request, string $uuid)
    {
        try {
            PlanSubscription::findOrFail($uuid)->update($request->validated());
            return redirect()->route('admin.plans.subscriptions.list')->with('success', 'Plan subscription updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.plans.subscriptions.list')->with('error', 'Failed to update plan subscription: ' . $e->getMessage());
        }
    }
}
