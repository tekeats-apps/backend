<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        return view('vendor.modules.tags.index');
    }

    public function create(){
        return view('vendor.modules.tags.create-edit');
    }
}
