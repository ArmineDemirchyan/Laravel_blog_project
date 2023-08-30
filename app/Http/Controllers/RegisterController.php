<?php

// app/Http/Controllers/RegisterController.php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\DTO\UserDTO;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:7'
        ]);

        $userDTO = new UserDTO(
            $attributes['name'],
            $attributes['username'],
            $attributes['email'],
            $attributes['password']
        );

        $user = $this->userRepository->create($userDTO);

        Auth::login($user);

        return redirect('/')->with('success', 'Your account has been created.');
    }
}
