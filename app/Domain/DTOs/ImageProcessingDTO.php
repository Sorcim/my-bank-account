<?php

namespace App\Domain\DTOs;

class ImageProcessingDTO
{
    public function __construct(
        public string $amount,
        public string $description,
        public string $date,
    )
    {
    }
}
