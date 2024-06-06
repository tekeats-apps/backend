<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait TenantImageUploadTrait
{
    protected $disk;

    public function __construct()
    {
        $this->disk = config('filesystems.default');
    }

    public function uploadImage($image, $folder = 'images', $id = null, $tableField = null, $tableName = null, $settingsModule = null): string
    {
        $this->disk = config('filesystems.default');
        $filename = $this->disk === 's3' ? $this->uploadToS3($image, $folder) : $this->uploadToLocal($image, $folder);

        if ($filename) {
            if (!$settingsModule) {
                $this->updateData($tableName, $tableField, $filename, $id);
            } else {
                $settingsModule->{$tableField} = $filename;
                $settingsModule->save();
            }
        }

        return $filename;
    }

    private function uploadToS3($image, $folder): string
    {
        $fileName = $this->generateFileName($image);

        $image->storeAs($folder, $fileName, 's3');

        return $fileName;
    }

    private function uploadToLocal($image, $folder): string
    {
        $fileName = $this->generateFileName($image);
        $this->createDirectory($folder);

        $image->storeAs($folder, $fileName, 'public');

        return $fileName;
    }

    private function generateFileName($image): string
    {
        return time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    }

    private function createDirectory($path): void
    {
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path, 0777, true, true);
        }
    }

    private function updateData($tableName, $tableField, $fileName, $id): void
    {
        DB::table($tableName)->where('id', $id)->update([$tableField => $fileName]);
    }

    public function delete_image_by_name($path, $fileName): void
    {
        $fullPath = $path . '/' . $fileName;

        if (Storage::disk($this->disk)->exists($fullPath)) {
            Storage::disk($this->disk)->delete($fullPath);
        }
    }
}
