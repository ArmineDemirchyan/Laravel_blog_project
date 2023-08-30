<?php


namespace App\DTO;

class UserDTO
{
    public string $name;
    public string $username;
    public string $email;
    public string $password;

    public function __construct(string $name, string $username, string $email, string $password)
    {
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}
