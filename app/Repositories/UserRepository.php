<?php


namespace App\Repositories;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function create(UserDTO $userDTO)
    {
        return User::create([
            'name' => $userDTO->name,
            'username' => $userDTO->username,
            'email' => $userDTO->email,
            'password' => Hash::make($userDTO->password),
        ]);
    }

    public function authenticate(UserDTO $userDTO)
    {
        $user = User::where('email', $userDTO->email)->first();

        if (!$user || !Hash::check($userDTO->password, $user->password)) {
            return null;
        }

        return $user;
    }
}
