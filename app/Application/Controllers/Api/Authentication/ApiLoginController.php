<?php

namespace App\Application\Controllers\Api\Authentication;

use App\Application\Requests\Authentication\LoginRequest;
use App\Application\Resources\UserResource;
use App\Domain\Services\TokenGenerator;
use App\Domain\UseCases\Authentication\LoginUserUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ApiLoginController
{
    public function __construct(private LoginUserUseCase $loginUserUseCase, private TokenGenerator $tokenGenerator) {}

    public function execute(LoginRequest $request): JsonResponse
    {
        $request->validated();

        $authResult = $this->loginUserUseCase->execute($request->get('email'), $request->get('password'));

        if (! $authResult->isSuccessful()) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $this->tokenGenerator->generate($authResult->user());

        return (new UserResource($authResult->user(), $token))->response()->setStatusCode(200);
    }
}
