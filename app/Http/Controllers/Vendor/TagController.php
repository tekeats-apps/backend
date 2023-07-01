<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Vendor\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Tags\CreateTagRequest;
use App\Http\Requests\Vendor\Tags\UpdateTagRequest;

class TagController extends Controller
{
    public function index()
    {
        return view('vendor.modules.tags.index');
    }

    public function create()
    {
        return view('vendor.modules.tags.create-edit');
    }

    public function store(CreateTagRequest $request)
    {
        try {
            $validatedData = $request->validated();

            Tag::createTag($validatedData);

            return redirect()->route('vendor.tags.list')->with('success', 'Tag has been successfully added.');
        } catch (Exception $e) {
            // Log the error
            Log::error('An error occurred while storing the tag: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the tag: ' . $e->getMessage());
        }
    }

    // Need to add this like function all other models to resuse at anywhere in app
    public function edit($tag)
    {
        $tag = Tag::getTagByID($tag);
        return view('vendor.modules.tags.create-edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, $tag)
    {
        try {
            $validatedData = $request->validated();

            Tag::updateTag($tag, $validatedData);

            return redirect()->route('vendor.tags.list')->with('success', 'Tag has been successfully added.');
        } catch (Exception $e) {
            // Log the error
            Log::error('An error occurred while storing the tag: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the tag: ' . $e->getMessage());
        }
    }

}
