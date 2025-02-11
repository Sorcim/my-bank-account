<?php

namespace App\Infrastructure\Services;

use App\Application\DTOs\ImageProcessingDTO;
use App\Domain\Services\ImageProcessingInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OpenAIImageProcessingService implements ImageProcessingInterface
{
    public function extractDataFromImage(string $imagePath): ImageProcessingDTO
    {
        $response = Http::withToken(env('OPENAI_KEY'))->post(
            'https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Analyse cette image d\'un ticket et retourne uniquement les données utiles sous forme JSON : - "emetteur" : le nom de l\'émetteur du ticket (par ex. le magasin ou l\'organisation) - "date" : la date du ticket au format YYYY-MM-DD - "montant" : le montant total au format X.XX',
                        ],
                        [
                            'type' => 'image_url',
                            'image_url' => [
                                'url' => "data:image/jpeg;base64," . base64_encode(Storage::get($imagePath)),
                            ],
                        ],
                    ],
                ],
            ]
        ]);


        if ($response->failed()) {
            Log::alert('Image processing failed', ['response' => $response->json()]);
            throw new \Exception('Image processing failed');
        }

        $rawContent = $response->json()["choices"][0]["message"]["content"];
        $cleanedContent = trim(str_replace(['json', '```'], '', $rawContent));
        $data = json_decode($cleanedContent, true);

        Log::info('Image processing succeeded', ['data' => $data]);
        if (!$data){
            Log::alert('Image processing failed', ['response' => $rawContent]);
            throw new \Exception('Image processing failed');
        }
        return new ImageProcessingDTO(
            $data['montant'],
            $data['emetteur'],
            $data['date']
        );
    }
}
