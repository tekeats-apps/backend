<?php

namespace App\Http\Controllers\Vendor;

use Exception;
use App\Models\Vendor\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Vendor\RestaurantOpeningHour;
use App\Http\Requests\Vendor\Settings\StoreOpeningHoursRequest;

class SettingController extends Controller
{
    public function systemSettings(Request $request)
    {
        $tab = $request->query('tab', 'custom-v-pills-restaurant-info');
        return view('vendor.modules.settings.system-settings', compact('tab'));
    }

    public function openingHours()
    {
        $openingHours = RestaurantOpeningHour::with('slots')->get();
        $days = RestaurantOpeningHour::DAYS;
        return view('vendor.modules.settings.opening-hours', compact('days', 'openingHours'));
    }

    public function saveOpeningHours(StoreOpeningHoursRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            foreach ($data['opening_hours'] as $day => $daysData) {
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
            DB::commit();
            // return response()->json(['success' => 'Opening hours updated successfully!'], 200);
            return redirect()->route('vendor.settings.opening.hours')->with('success', 'Opening hours updated successfully!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('vendor.settings.opening.hours')->with('error', $e->getMessage());
        }
    }

    private function updateSlots($openingHour, $slotsData)
    {
        // Get current slot IDs for this OpeningHour
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

        // Find IDs of slots to be removed
        $slotsToRemove = array_diff($currentSlotIds, $newSlotIds);

        // Delete the removed slots
        Slot::whereIn('id', $slotsToRemove)->delete();
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
