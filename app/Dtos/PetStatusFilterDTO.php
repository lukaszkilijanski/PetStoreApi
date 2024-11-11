<?php
declare(strict_types=1);

/**
 * File: PetStatusFilterDTO.php
 *
 * @author Łukasz Kilijański <kilijanski.lukasz@gmail.com>
 */

namespace App\Dtos;

use App\Enums\PetStatuses;
use Illuminate\Http\Request;

class PetStatusFilterDTO
{
    private const DEFAULT_PET_STATUS = PetStatuses::Available->value;
    public ?string $petStatus;
    public function __construct(Request $request)
    {
        $this->petStatus = $request->query('status') ?: self::DEFAULT_PET_STATUS;
    }
}
