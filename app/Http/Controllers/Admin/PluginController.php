<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plugin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PluginRequest;

class PluginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Plugin::all());
        return view('admin.modules.plugins.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.plugins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PluginRequest $request)
    {
        try {
            Plugin::create($request->validated());
            return redirect()->route('admin.plugins.list')->with('success', 'Plugin created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.plugins.list')->with('error', 'Failed to create plugin: ' . $e->getMessage());
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
            $plugin = Plugin::findOrFail($id);
            return view('admin.modules.plugins.edit', compact('plugin'));
        } catch (\Exception $e) {
            return redirect()->route('admin.plugins.list')->with('error', 'Failed to get plugin: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PluginRequest $request, string $id)
    {
        try {
            $plugin = Plugin::findOrFail($id);
            $plugin->update($request->validated());
            return redirect()->route('admin.plugins.list')->with('success', 'Plugin updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.plugins.list')->with('error', 'Failed to create plugin: ' . $e->getMessage());
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
