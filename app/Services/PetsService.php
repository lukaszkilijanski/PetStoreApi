<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\PetsServiceInterface;
use App\Dtos\CreateOrUpdatePetDTO;
use App\Models\Pet;
use Illuminate\Support\Facades\Http;
use App\Factories\PetFactory;

class PetsService implements PetsServiceInterface
{
    public function __construct(
        private PetFactory $petFactory
    ) {}

    public function getPetsListByStatusName(string $statusName): array
    {
        $response = Http::get(
            $this->getIndicatedUrl(self::PET_STORE_FIND_BY_STATUS),
            [self::STATUS_PARAM_NAME => $statusName]
        );
        return $response->json();
    }

    public function getPetById(int $petId): Pet
    {
        $response = Http::get(
            $this->getIndicatedUrl(self::PET_BY_ID).$petId
        );
        return $this->petFactory->create( new CreateOrUpdatePetDTO($response->json()));
    }

    private function getIndicatedUrl(string $apiPath): string
    {
        return config(self::PET_STORE_BASE_API) . config($apiPath);
    }

    public function updatePet(CreateOrUpdatePetDTO $dto): bool
    {
        $data = [
            "id" => $dto->petId,
            "category" => [
                "id" => $dto->category['id'],
                "name" => $dto->category['name'],
            ],
            "name" => $dto->name,
            "photoUrls" => [
                "string"
            ],
            "tags" => $dto->tags,
            "status" => $dto->status
        ];

        $response = Http::post($this->getIndicatedUrl(self::POST_UPDATE_PET), $data);
        return $response->successful();
    }
}
