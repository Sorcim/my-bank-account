<?php

namespace App\Application\Controllers\Authentication;

use App\Application\Requests\Authentication\LoginRequest;
use App\Domain\UseCases\Authentication\LoginUser;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

readonly class LoginController
{
    public function __construct(private LoginUser $authenticateUser) {}

    public function render(): Response
    {
        return Inertia::render('Authentication/Login');
    }

    public function execute(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($this->authenticateUser->execute($data['email'], $data['password'])) {
            auth()->attempt($data);
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
}
