<?php
declare(strict_types=1);
namespace RestClient\Authentication\JWTAuthentication;

class AccessToken
{
    public function __construct(private $accessToken) {}

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setAccessToken($accessToken): string
    {
        $this->accessToken = $accessToken;
        return $accessToken;
    }
}