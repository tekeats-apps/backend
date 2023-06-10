<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function commingSoon()
    {
        return view('vendor.coming_soon');
    }
}
