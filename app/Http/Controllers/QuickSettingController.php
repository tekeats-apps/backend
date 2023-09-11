<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\TenantImageUploadTrait;

class QuickSettingController extends Controller
{
    use TenantImageUploadTrait;

    public function removeDropifyImage(Request $request)
    {
        $imagePath = $request->input('imagePath');
        $recordId = $request->input('recordId');
        $tableField = $request->input('tableField');
        $tableName = $request->input('tableName'); // Change the parameter name

        $record = DB::table($tableName)->find($recordId);

        if ($record) {
            $fieldValue = $record->{$tableField};
            if ($fieldValue) {
                $this->delete_image_by_name($imagePath, $fieldValue);

                // Update the field value to null
                DB::table($tableName)->where('id', $recordId)->update([$tableField => null]);

                return response()->json(['status' => true, 'message' => 'Image removed successfully']);
            } else {
                return response()->json(['status' => false, 'message' => 'No image found for the specified field']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Record not found']);
        }
    }
}
