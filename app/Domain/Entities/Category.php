<?php

namespace App\Domain\Entities;

class Category
{
    public string $id;
    public string $name;
    public string $color;
    public string $userId;

    public function __construct(string $id, string $name, string $color, string $userId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->userId = $userId;
    }
}
