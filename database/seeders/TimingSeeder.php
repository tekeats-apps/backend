<?php

namespace Database\Seeders;

use App\Models\Vendor\Slot;
use Illuminate\Database\Seeder;
use App\Models\Vendor\RestaurantOpeningHour;

class TimingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timingData = json_decode(file_get_contents(database_path('seeds/timing.json')), true);

        foreach ($timingData['opening_hours'] as $day => $daysData) {
            $openingHour = RestaurantOpeningHour::updateOrCreate(
                ['day' => $day],
                [
                    'day' => $day,
                    'is_closed' => $daysData['is_closed'] ?? 0
                ]
            );
            // Update the slots
            $this->updateSlots($openingHour, $daysData['slots']);
        }
    }

    private function updateSlots($openingHour, $slotsData)
    {
        $currentSlotIds = $openingHour->slots()->pluck('id')->toArray();

        $newSlotIds = [];

        foreach ($slotsData as $slot) {
            // Create or update the slot
            $slot = Slot::updateOrCreate([
                'restaurant_opening_hour_id' => $openingHour->id,
                'open_time' => $slot['open_time'],
                'close_time' => $slot['close_time'],
            ]);

            $newSlotIds[] = $slot->id;
        }

        $slotsToRemove = array_diff($currentSlotIds, $newSlotIds);

        Slot::whereIn('id', $slotsToRemove)->delete();
    }
}
