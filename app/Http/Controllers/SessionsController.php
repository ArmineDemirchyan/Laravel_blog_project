<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\DTO\UserDTO;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create()
    {
        return view('sessions.create'); // Assuming this is your login form view
    }

    public function store()
    {
        $userDTO = new UserDTO('', '', request('email'), request('password'));

        $user = $this->userRepository->authenticate($userDTO);

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Your provided credentials could not be verified']
            ]);
        }

        auth()->login($user);
        session()->regenerate();
        return redirect('/')->with('success', 'Welcome Back!');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye!');
    }
}
