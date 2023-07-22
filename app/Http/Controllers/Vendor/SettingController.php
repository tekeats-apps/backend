<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function systemSettings(Request $request)
    {
        $tab = $request->query('tab', 'custom-v-pills-restaurant-info');
        return view('vendor.modules.settings.system-settings', compact('tab'));
    }

    public function paymentSettings()
    {
        return view('vendor.modules.settings.payment-settings');
    }

    public function notificationSettings()
    {
        return view('vendor.modules.settings.notification-settings');
    }

    public function storageSettings()
    {
        return view('vendor.modules.settings.storage-settings');
    }
}
