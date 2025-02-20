<?php

namespace App\Application\Controllers\Web\Authentication;

use App\Application\Requests\Authentication\LoginRequest;
use App\Domain\Services\SessionAuthenticator;
use App\Domain\UseCases\Authentication\LoginUserUseCase;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

readonly class LoginController
{
    public function __construct(private LoginUserUseCase $authenticateUser, private SessionAuthenticator $sessionAuthenticator) {}

    public function render(): Response
    {
        return Inertia::render('Authentication/Login');
    }

    public function execute(LoginRequest $request): RedirectResponse
    {
        $request->validated();
        $authResult = $this->authenticateUser->execute($request->get('email'), $request->get('password'));
        if (! $authResult->isSuccessful()) {
            return back()->withErrors(['email' => 'Wrong email or password']);
        }
        $this->sessionAuthenticator->login($authResult->user());

        return redirect()->route('home');
    }
}
