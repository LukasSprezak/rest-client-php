<?php
declare(strict_types=1);
namespace RestClient\Authentication\BasicAuthentication;

class BasicAuthentication
{
    private const BASIC_NAME = 'Basic';

    protected string $separator = ' ';

    public function __construct(private string $user, private string $password, protected string $name = self::BASIC_NAME) {}

    public function getContent() : string
    {
        $credential  = sprintf("%s:%s", $this->user, $this->password);
        $auth = base64_encode($credential);

        return sprintf("%s%s%s", $this->name, $this->separator, $auth);
    }
}