<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanFeatureRequest;
use App\Models\PlanFeature;
use Illuminate\Http\Request;

class PlanFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.modules.plan-features.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.plan-features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanFeatureRequest $request)
    {
        try {
            PlanFeature::create($request->validated());
            return redirect()->route('admin.plans.features.list')->with('success', 'Plan feature created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.plans.features.list')->with('error', 'Failed to create plan feature: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $planFeature = PlanFeature::findOrFail($id);
            return view('admin.modules.plan-features.show', compact('planFeature'));
        } catch (\Exception $e) {
            return redirect()->route('admin.plans.features.list')->with('error', 'Failed to get plan features: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $planFeature = PlanFeature::findOrFail($id);
            return view('admin.modules.plan-features.edit', compact('planFeature'));
        } catch (\Exception $e) {
            return redirect()->route('admin.plans.features.list')->with('error', 'Failed to get plan features: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanFeatureRequest $request, string $id)
    {
        try {
            PlanFeature::findOrFail($id)->update($request->validated());
            return redirect()->route('admin.plans.features.list')->with('success', 'Plan feature updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.plans.features.list')->with('error', 'Failed to update plan feature: ' . $e->getMessage());
        }
    }
}
