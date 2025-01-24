<?php

namespace App\Domain\Entities;

class Category
{
    public function __construct(
        public string $id,
        public string $name,
        public string $color
    )
    {
    }
}
