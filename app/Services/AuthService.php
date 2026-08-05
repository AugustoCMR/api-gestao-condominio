<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class AuthService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function login(array $data): array
    {
        $user = $this->validateCredentials($data['email'], $data['password']);

        [$accessToken, $refreshToken] = $this->handleTokens($user);

        return [
            'sub'           => $user->uuid,
            'name'          => $user->name,
            'access_token'  => $accessToken->plainTextToken,
            'refresh_token' => $refreshToken->plainTextToken,
        ];
    }

    public function validateCredentials(string $email, string $password): User
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password))
        {
            throw new InvalidCredentialsException();
        }

        return $user;
    }

    public function handleTokens(User $user): array
    {
        $user->tokens()->delete();

        $accessToken  = $user->createToken('access_token', ['*'], now()->addMinutes(15));
        $refreshToken = $user->createToken('refresh_token', ['refresh'], now()->addDays(7));

        return [$accessToken, $refreshToken];
    }
}
