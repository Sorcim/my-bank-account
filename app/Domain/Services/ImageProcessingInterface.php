<?php

namespace App\Domain\Services;

use App\Application\DTOs\ImageProcessingDTO;

interface ImageProcessingInterface
{
    public function extractDataFromImage(string $imagePath): ImageProcessingDTO;
}
