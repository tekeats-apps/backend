<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait TenantImageUploadTrait
{
    private $disk; // Global disk variable

    public function __construct()
    {
        $this->disk = config('filesystems.default');
    }

    public function uploadImage($image, $folder = 'images', $id, $tableField, $tableName)
    {
        $filename = $this->disk === 's3' ? $this->uploadToS3($image, $folder) : $this->uploadToLocal($image, $folder);

        if ($filename) {
            $this->updateData($tableName, $tableField, $filename, $id);
        }

        return $filename;
    }

    private function uploadToS3($image, $folder)
    {
        $fileName = $this->generateFileName($image);

        $image->storeAs($folder, $fileName, 's3');

        return $fileName;
    }

    private function uploadToLocal($image, $folder)
    {
        $fileName = $this->generateFileName($image);
        $this->createDirectory($folder);

        $image->storeAs($folder, $fileName, 'public');

        return $fileName;
    }

    private function generateFileName($image)
    {
        return time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    }

    private function createDirectory($path)
    {
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path, 0777, true, true);
        }
    }

    private function updateData($tableName, $tableField, $fileName, $id)
    {
        DB::table($tableName)->where('id', $id)->update([$tableField => $fileName]);
    }

    public function delete_image_by_name($path, $fileName)
    {
        $fullPath = $path . '/' . $fileName;

        if (Storage::disk($this->disk)->exists($fullPath)) {
            Storage::disk($this->disk)->delete($fullPath);
        }
    }
}
