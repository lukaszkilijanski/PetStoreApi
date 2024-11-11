<?php
declare(strict_types=1);

/**
 * File: PetFactory.php
 *
 * @author Łukasz Kilijański <kilijanski.lukasz@gmail.com>
 */


namespace App\Factories;

use App\Dtos\CreateOrUpdatePetDTO;
use App\Models\Pet;

class PetFactory
{
    public function create(CreateOrUpdatePetDTO $dto): Pet
    {
        return new Pet(
            $dto->petId,
            $dto->category,
            $dto->name,
            $dto->photoUrls,
            $dto->tags,
            $dto->status
        );
    }
}
