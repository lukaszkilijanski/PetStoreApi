<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\PetsServiceInterface;
use App\Dtos\CreateOrUpdatePetDTO;
use App\Dtos\PetStatusFilterDTO;
use Illuminate\Http\Request;
use App\Enums\PetStatuses;
use App\Models\Pet;
use Illuminate\Support\Facades\Http;

class PetsController extends Controller
{
    public function __construct(
        private readonly PetsServiceInterface $petsService
    ) {}

    public function index(Request $request)
    {
        $petStatusFilterDTO = new PetStatusFilterDTO($request);
        $pets = $this->petsService->getPetsListByStatusName($petStatusFilterDTO->petStatus);
        return view('pets-index', [
            'selectedStatus' => $petStatusFilterDTO->petStatus,
            'petStatuses' => PetStatuses::cases(),
            'pets' => $pets
        ]);
    }

    public function edit(int $petId)
    {
        $pet = $this->petsService->getPetById((int)$petId);

        return view('pet-edit', [
            'pet' => $pet,
            'petStatuses' => PetStatuses::cases(),
        ]);
    }

    public function save(Request $request)
    {

        $tags = [];
        foreach ($request->post() as $key => $value) {
            if (strpos($key, 'new_tag') || strpos($key, 'existing_tag')) {
                $tags[] = [
                    'id' => rand(2, 30),
                    'name' => $value
                ];
            }
        }

        $dtoArray = [
            'id' => (int)$request->post()['id'],
            'name' => $request->post()['name'],
            'category' => ['name' => $request->post()['category']['name'], 'id' => rand(2, 30)],
            'tags' => $tags,
            'status' => $request->post()['status'],
            'photoUrls' => [],
        ];

        $result = $this->petsService->updatePet(new createOrUpdatePetDTO($dtoArray));
        if($result){

            session()->flash('success', 'Pet has been updated.!');

            return redirect()->action([PetsController::class, 'edit'], ['petId' => (int)$request->post()['id']]);

        }

    }
}
