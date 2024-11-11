<?php
declare(strict_types=1);

/**
 * File: PetStatuses.php
 *
 * @author Łukasz Kilijański <kilijanski.lukasz@gmail.com>
 */

namespace App\Enums;

enum PetStatuses: string
{
    case Available = "available";
    case Pending = "pending";
    case Sold = "sold";
}
