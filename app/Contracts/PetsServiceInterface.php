<?php
declare(strict_types=1);

namespace App\Contracts;

use App\Dtos\CreateOrUpdatePetDTO;
use App\Models\Pet;

interface PetsServiceInterface
{
    public const PET_STORE_BASE_API = 'api.petstore.base_url';
    public const PET_STORE_FIND_BY_STATUS = 'api.petstore.find_by_status';
    public const PET_BY_ID = 'api.petstore.find_by_id';
    public const POST_UPDATE_PET = 'api.petstore.update_pet';
    public const STATUS_PARAM_NAME = 'status';
    public function getPetsListByStatusName(string $statusName): array;
    public function getPetById(int $petId): Pet;

    public function updatePet(CreateOrUpdatePetDTO $dto): bool;
}
