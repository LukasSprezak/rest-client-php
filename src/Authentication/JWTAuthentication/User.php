<?php
declare(strict_types=1);
namespace RestClient\Authentication\JWTAuthentication;

class User
{
    public function __construct(private $user, private $password) {}

    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser($user): string
    {
        $this->user = $user;
        return $user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): string
    {
        $this->password = $password;
        return $password;
    }
}