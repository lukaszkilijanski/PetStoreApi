<?php
declare(strict_types=1);

namespace App\Providers;

use App\Contracts\PetsServiceInterface;
use App\Services\PetsService;
use Illuminate\Support\ServiceProvider;

class PetServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(PetsServiceInterface::class, PetsService::class);
    }

    public function boot(): void
    {
        //
    }
}
