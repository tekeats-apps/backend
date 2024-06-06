<?php

namespace App\Tenancy\Bootstrappers;

use DB;
use App\Settings\OneSignalSettings;
use Stancl\Tenancy\Contracts\Tenant;
use Illuminate\Support\Facades\Config;
use Stancl\Tenancy\Contracts\TenancyBootstrapper;

class OneSignalBootstrapper implements TenancyBootstrapper
{
    protected $oneSignalSettings;

    public function __construct(OneSignalSettings $oneSignalSettings)
    {
        $this->oneSignalSettings = $oneSignalSettings;
    }

    public function bootstrap(Tenant $tenant)
    {
        // Check if the migration has been run
        if (!$this->migrationHasBeenRun('2024_04_09_050400_create_onesignal_settings')) {
            // Possibly log this situation or handle it accordingly
            return;
        }

        $apiKey = $this->oneSignalSettings->api_key;
        $appId = $this->oneSignalSettings->app_id;

        Config::set('services.onesignal.app_id', $appId);
        Config::set('services.onesignal.rest_api_key', $apiKey);
    }

    public function revert()
    {
        // You can revert to the default settings or clear the OneSignal configuration
        Config::set('services.onesignal.app_id', null);
        Config::set('services.onesignal.rest_api_key', null);
    }

    private function migrationHasBeenRun($migrationName)
    {
        return DB::table('migrations')->where('migration', $migrationName)->exists();
    }
}
