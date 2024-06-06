<?php

namespace App\Services\Platform;

use App\Models\Vendor\Extra;
use App\Repositories\Platform\Extra\ExtraRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExtraService
{
    protected ExtraRepository $extraRepository;

    public function __construct(ExtraRepository $extraRepository)
    {
        $this->extraRepository = $extraRepository;
    }
    public function getExtras()
    {
        return $this->extraRepository->getExtras();
    }

    public function getExtraDetails(int $id)
    {
        return $this->extraRepository->getExtraById($id);
    }

    public function createExtra(array $data)
    {
        return $this->extraRepository->createExtra($data);
    }

    public function updateExtra(Extra $extra, array $data)
    {
        if (!$extra) {
            throw new ModelNotFoundException('Category not found');
        }
        $extra->update($data);
        return $extra;
    }

}