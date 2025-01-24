<?php

namespace App\Domain\Services;

use App\Domain\DTOs\ImageProcessingDTO;

interface ImageProcessingService
{
    public function extractDataFromImage(string $imagePath): ImageProcessingDTO;
}
