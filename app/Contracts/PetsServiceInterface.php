<?php
declare(strict_types=1);

namespace App\Contracts;

interface PetsServiceInterface
{
    public const PET_STORE_BASE_API = 'api.petstore.base_url';
    public const PET_STORE_FIND_BY_STATUS = 'api.petstore.find_by_status';
    public const STATUS_PARAM_NAME = 'status';
    public function getPetsListByStatusName(string $statusName): array;
}
