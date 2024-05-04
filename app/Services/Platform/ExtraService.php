<?php

namespace App\Services\Platform;

use App\Repositories\Platform\Extra\ExtraRepository;

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

}