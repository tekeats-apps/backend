<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PluginTypeRequest;
use App\Models\PluginType;
use Illuminate\Http\Request;

class PluginTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.modules.plugin-types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.plugin-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PluginTypeRequest $request)
    {
        try {
            PluginType::create($request->validated());
            return redirect()->route('admin.plugin.types.list')->with('success', 'Plugin type created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.plugin.types.list')->with('error', 'Failed to create plugin type: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $pluginType = PluginType::findOrFail($id);
            return view('admin.modules.plugin-types.edit', compact('pluginType'));
        } catch (\Exception $e) {
            return redirect()->route('admin.plugin.types.list')->with('error', 'Failed to get plugin type: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PluginTypeRequest $request, string $id)
    {
        try {
            PluginType::findOrFail($id)->update($request->validated());
            return redirect()->route('admin.plugin.types.list')->with('success', 'Plugin type updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.plugin.types.list')->with('error', 'Failed to update plugin type: ' . $e->getMessage());
        }
    }
}
