<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function generalSettings()
    {
        return view('store.modules.settings.general-settings');
    }

    public function paymentSettings(){
        return view('store.modules.settings.payment-settings');
    }

    public function notificationSettings(){
        return view('store.modules.settings.notification-settings'); 
    }

    public function deliverySettings(){
        return view('store.modules.settings.delivery-settings');
    }

    public function storageSettings(){
        return view('store.modules.settings.storage-settings'); 
    }

    public function themeSettings(){
        return view('store.modules.settings.theme-settings'); 
    }
}
