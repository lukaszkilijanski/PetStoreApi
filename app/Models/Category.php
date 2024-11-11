<?php
declare(strict_types=1);

/**
 * File: Category.php
 *
 * @author Łukasz Kilijański <kilijanski.lukasz@gmail.com>
 */

namespace App\Models;

use App\Dtos\CreateCategoryDTO;

class Category
{
    public int $id;
    public string $name;

    public function __construct(CreateCategoryDTO $dto) {
        $this->id = $dto->categoryId;
        $this->name = $dto->categoryName;
    }
}
