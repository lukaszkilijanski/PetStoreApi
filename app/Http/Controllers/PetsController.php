<?php
declare(strict_types=1);

/**
 * File: PetsController.php
 *
 * @author Łukasz Kilijański <kilijanski.lukasz@gmail.com>
 */

namespace App\Http\Controllers;

use App\Contracts\PetsServiceInterface;
use App\Dtos\CreateOrUpdatePetDTO;
use App\Dtos\PetStatusFilterDTO;
use Illuminate\Http\Request;
use App\Enums\PetStatuses;

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
        if ($pet) {
            return view('pet-edit', [
                'pet' => $pet,
                'petStatuses' => PetStatuses::cases(),
            ]);
        }

        session()->flash('error', 'Pet with id: ' . $petId . ' is not found.');
        return redirect()->route('pets');
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
        $petId = (int)$request->post()['id'] ?: rand(2, 5000);
        $dtoArray = [
            'id' => $petId,
            'name' => $request->post()['name'],
            'category' => ['name' => $request->post()['category']['name'], 'id' => rand(2, 30)],
            'tags' => $tags,
            'status' => $request->post()['status'],
            'photoUrls' => [],
        ];

        $result = $this->petsService->updatePet(new createOrUpdatePetDTO($dtoArray));
        if ($result) {
            session()->flash('success', 'Pet has been saved.!');
            return redirect()->action([PetsController::class, 'edit'], ['petId' => $petId]);
        }
    }

    public function remove(Request $request)
    {
        $statusOfResponse = $this->petsService->removePet((int)$request->get('petId'));

        if ($statusOfResponse === 200) {
            session()->flash('success', 'Pet with id: ' . $request->get('petId') . ' has been removed.');
        }
        if ($statusOfResponse === 404) {
            session()->flash('error', 'Pet not found. Pet with id: ' . $request->get('petId') . ' is not deleted.');
        }

        return redirect()->route('pets');
    }

    public function create()
    {
        return view('pet-edit', [
            'petStatuses' => PetStatuses::cases(),
        ]);
    }

    public function find(Request $request)
    {
        $petId = (int)$request->get('id');

        $pet = $this->petsService->getPetById($petId);
        if ($pet) {
            session()->flash('success', 'Pet with id: ' . $petId . ' has been found. You edit this pet here.');
            return view('pet-edit', [
                'pet' => $pet,
                'petStatuses' => PetStatuses::cases(),
            ]);
        }
        session()->flash('error', 'Pet with id: ' . $petId . ' is not found.');
        return redirect()->route('pets');
    }
}
