<?php
declare(strict_types=1);

/**
 * File: PetServiceProvider.php
 *
 * @author Łukasz Kilijański <kilijanski.lukasz@gmail.com>
 */

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
