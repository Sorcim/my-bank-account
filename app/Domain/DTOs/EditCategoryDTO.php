<?php

namespace App\Domain\DTOs;

class EditCategoryDTO
{
    public ?string $name;
    public ?string $color;

    public function __construct(?string $name,?string $color)
    {
        $this->name = $name;
        $this->color = $color;
    }
}
