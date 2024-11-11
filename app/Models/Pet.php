<?php
declare(strict_types=1);

/**
 * File: Pet.php
 *
 * @author Łukasz Kilijański <kilijanski.lukasz@gmail.com>
 */

namespace App\Models;

class Pet
{
    public int $id;
    public array $category;
    public string $name;
    public array $photoUrls = [];
    public array $tags = [];
    public string $status;

    public function __construct($id, $category, $name, $photoUrls, $tags, $status)
    {
        $this->id = $id;
        $this->category = $category;
        $this->name = $name;
        $this->photoUrls = $photoUrls;
        $this->tags = $tags;
        $this->status = $status;
    }
}
