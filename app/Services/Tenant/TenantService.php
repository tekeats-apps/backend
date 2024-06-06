<?php

namespace App\Services\Tenant;

use DateTime;
use Spatie\OpeningHours\OpeningHours;
use App\Models\Vendor\RestaurantOpeningHour;

class TenantService {

    protected $openingHours;

    public function __construct(RestaurantOpeningHour $openingHours)
    {
        $this->openingHours = $openingHours;
    }

    public function isCurrentlyOpen() {

        $tenantHours = $this->openingHours->with('slots')->get()->toArray();
        $openingHoursArray = $this->formatOpeningHours($tenantHours);
        $openingHours = OpeningHours::create($openingHoursArray);

        $now = new DateTime('now');
        return $openingHours->isOpenAt($now);
    }

    private function formatOpeningHours(array $openingHoursData) {
        $formatted = [];

        foreach ($openingHoursData as $dayData) {
            $dayName = $dayData['day'];
            if ($dayData['is_closed']) {
                // If the restaurant is closed on this day, set the value to '[]'
                $formatted[$dayName] = [];
            } else {
                // Otherwise, format the opening and closing times
                $formatted[$dayName] = array_map(function ($slot) {
                    $openTime = (new \DateTime($slot['open_time']))->format('H:i');
                    $closeTime = (new \DateTime($slot['close_time']))->format('H:i');
                    return $openTime . '-' . $closeTime;
                }, $dayData['slots']);
            }
        }

        return $formatted;
    }
    
}