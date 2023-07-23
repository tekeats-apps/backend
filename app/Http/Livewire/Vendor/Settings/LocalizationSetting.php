<?php

namespace App\Http\Livewire\Vendor\Settings;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\Vendor\LocalizationSetting as Localization;

class LocalizationSetting extends Component
{
    public $allowedLanguages;
    public $allowedTimezones;
    public $allowedDateFormats;
    public $allowedTimeFormats;
    public $allowedCurrencies;
    public $currencySymbols;

    //Model Fields
    public $languages = ['en'];
    public $default_language = 'en';
    public $timezone = 'UTC';
    public $date_format = 'm-d-Y';
    public $time_format = 'H:i:s';
    public $currency = 'USD';
    public $currency_symbol = '$';
    public $currency_position = 'left';

    protected function rules()
    {
        return [
            'languages' => 'required',
            'default_language' => 'required|string',
            'timezone' => 'required|string',
            'date_format' => 'required|string',
            'time_format' => 'required|string',
            'currency' => 'required|string',
            'currency_symbol' => 'required|string',
            'currency_position' => 'required|string|in:left,right'
        ];
    }

    public function mount()
    {
        $this->allowedLanguages = config('localization.languages');
        $this->allowedTimezones = config('localization.timezones');
        $this->allowedDateFormats = config('localization.date_formats');
        $this->allowedTimeFormats = config('localization.time_formats');
        $this->allowedCurrencies = config('localization.currencies');
        $this->currencySymbols = config('localization.currency_symbols');
        $this->updateCurrencySymbol();
        $this->loadLocalizationSetting();
    }

    public function loadLocalizationSetting()
    {
        $localizationSetting = Localization::first();
        if ($localizationSetting) {
            $this->languages = $localizationSetting->languages;
            $this->default_language = $localizationSetting->default_language;
            $this->timezone = $localizationSetting->timezone;
            $this->date_format = $localizationSetting->date_format;
            $this->time_format = $localizationSetting->time_format;
            $this->currency = $localizationSetting->currency;
            $this->currency_symbol = $localizationSetting->currency_symbol;
            $this->currency_position = $localizationSetting->currency_position;
        }
    }

    public function updateCurrencySymbol()
    {
        $this->currency_symbol = $this->currencySymbols[$this->currency] ?? null;
    }

    public function render()
    {
        return view('livewire.vendor.settings.localization-setting');
    }

    public function save()
    {
        $validatedData = $this->validate();
        try {
            $localization = Localization::first();
            if ($localization) {
                $localization->update($validatedData);
            } else {
                Localization::create($validatedData);
            }

            session()->flash('message', 'Delivery Settings Successfully Updated.');
        } catch (Exception $e) {
            Log::error('An error occurred while updating the restaurant localization settings: ', ['error' => $e]);
            session()->flash('error', 'An error occurred while updating the restaurant localization settings:' . $e->getMessage());
        }
    }
}
