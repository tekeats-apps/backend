<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Storage;

trait TenantImageUploadTrait
{
    public function uploadImage($image, $folder = 'images', $id, $table_field, $table_name)
    {
        $storageType = config('image_upload.storage');
        $filename = '';
        if ($storageType === 's3') {
            $filename = $this->uploadToS3($image, $folder);
        } else {
            $filename =  $this->uploadToLocal($image, $folder);
        }
        if ($filename) {
            $this->update_data($table_name, $table_field, $filename, $id);
        }
        return $filename;
    }

    private function uploadToS3($image, $folder)
    {
        $fileName = $this->generateFileName($image);

        $path = $image->storeAs($folder, $fileName, 's3');

        return $path;
    }

    private function uploadToLocal($image, $folder)
    {
        $fileName = $this->generateFileName($image);
        $this->createDirecrtory($folder);

        $image->storeAs($folder, $fileName, 'public');

        return $fileName;
    }

    private function generateFileName($image)
    {
        return time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    }

    private function createDirecrtory($path)
    {
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path, 0777, true, true);
        }
    }

    private function update_data($table_name, $table_field, $file_name, $id)
    {
        DB::table($table_name)->where('id', $id)->update([$table_field => $file_name]);
    }

    public function delete_image_by_name($path, $file_name)
    {

        $fullPath = $path . '/' . $file_name;
        if (Storage::disk('public')->exists($fullPath)) {
            Storage::disk('public')->delete($fullPath);
        }
    }
}
