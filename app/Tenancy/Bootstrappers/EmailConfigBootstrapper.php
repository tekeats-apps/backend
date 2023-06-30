<?php

namespace App\Tenancy\Bootstrappers;

use App\Models\Vendor\MailConfig;
use Stancl\Tenancy\Contracts\Tenant;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Stancl\Tenancy\Contracts\TenancyBootstrapper;

class EmailConfigBootstrapper implements TenancyBootstrapper
{
    public function bootstrap(Tenant $tenant)
    {
        if ($tenant) {
            if (Schema::hasTable('mail_configs')) {
                $config = MailConfig::first();
                if ($config) {
                    // Set the email configuration for the tenant
                    Config::set('mail.mailers.smtp.host', $config->host);
                    Config::set('mail.mailers.smtp.port', $config->port);
                    Config::set('mail.mailers.smtp.username', $config->username);
                    Config::set('mail.mailers.smtp.password', $config->password);
                    Config::set('mail.mailers.smtp.encryption', $config->encryption);

                    // Set the FROM address and name for the tenant
                    Config::set('mail.from.address', $config->from_address);
                    Config::set('mail.from.name', $config->from_name);
                } else {
                    // Set the email configuration as null
                    Config::set('mail.mailers.smtp.host', null);
                    Config::set('mail.mailers.smtp.port', null);
                    Config::set('mail.mailers.smtp.username', null);
                    Config::set('mail.mailers.smtp.password', null);
                    Config::set('mail.mailers.smtp.encryption', null);

                    // Set the FROM address and name as null
                    Config::set('mail.from.address', null);
                    Config::set('mail.from.name', null);
                }
            }
        }
    }



    public function revert()
    {
        // ...
    }
}
