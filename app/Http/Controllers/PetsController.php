<?php

namespace App\Http\Controllers;

use App\DTO\PetStatusFilterDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Enums\PetStatuses;

class PetsController extends Controller
{
    public function index(Request $request)
    {
        $petStatusFilterDTO = new PetStatusFilterDTO($request);

        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus', [
            'status' => $petStatusFilterDTO->petStatus
        ]);
        $pets = $response->json();
        return view('pets-index', [
            'selectedStatus' => $petStatusFilterDTO->petStatus,
            'petStatuses' => PetStatuses::cases(),
            'pets' => $pets
        ]);
    }
}
