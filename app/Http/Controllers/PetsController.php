<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\PetsServiceInterface;
use App\DTO\PetStatusFilterDTO;
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
}
