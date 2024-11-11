<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\PetsServiceInterface;
use Illuminate\Support\Facades\Http;

class PetsService implements PetsServiceInterface
{
    public function getPetsListByStatusName(string $statusName): array
    {
        $url = config(self::PET_STORE_BASE_API).config(self::PET_STORE_FIND_BY_STATUS);

        $response = Http::get($url, [
            self::STATUS_PARAM_NAME => $statusName
        ]);

        return $response->json();
    }
}
