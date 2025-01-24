<?php

namespace App\Domain\DTOs;

class CreateCategoryDTO
{
    public string $name;
    public string $color;
    public string $userId;

    public function __construct(string $name,string $color, string $userId)
    {
        $this->name = $name;
        $this->color = $color;
        $this->userId = $userId;
    }
}
