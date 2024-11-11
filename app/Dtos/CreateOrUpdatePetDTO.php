<?php
declare(strict_types=1);

namespace App\Dtos;

class CreateOrUpdatePetDTO
{
    public int $petId;
    public string $name;
    public array $category;
    public array $tags;
    public string $status;
    public array $photoUrls;

    public function __construct(
        array $dataArray
    )
    {
        $this->petId = $dataArray['id'];
        $this->name = $dataArray['name'];
        $this->category = $dataArray['category'];
        $this->tags = $dataArray['tags'];
        $this->status = $dataArray['status'];
        $this->photoUrls = $dataArray['photoUrls'];
    }

}
