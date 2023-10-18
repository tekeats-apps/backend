<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plugin;
use App\Models\PluginType;
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
        return view('admin.modules.plugins.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pluginTypes = PluginType::all();
        return view('admin.modules.plugins.create', compact('pluginTypes'));
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
        try {
            $plugin = Plugin::with('type')->findOrFail($id);
            return view('admin.modules.plugins.show', compact('plugin'));
        } catch (\Exception $e) {
            return redirect()->route('admin.plugins.list')->with('error', 'Failed to get plugin: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $pluginTypes = PluginType::all();
            $plugin = Plugin::with('type')->findOrFail($id);
            return view('admin.modules.plugins.edit', compact('pluginTypes', 'plugin'));
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
            return redirect()->route('admin.plugins.list')->with('error', 'Failed to update plugin: ' . $e->getMessage());
        }
    }
}
