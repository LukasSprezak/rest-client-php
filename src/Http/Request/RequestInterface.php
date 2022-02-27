<?php
declare(strict_types=1);
namespace RestClient\Http\Request;

interface RequestInterface
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const PATCH = 'PATCH';
    public const DELETE = 'DELETE';

    public function setHost(string $host): RequestInterface;

    public function getHost(): string;

    public function setMethod(string $method): RequestInterface;

    public function getMethod(): string;

    public function getUri(): string;

    public function setUri(string $uri): RequestInterface;


    public function addHeaders(array $headers): RequestInterface|static;

    public function getHeaders(): array;

    public function addDetails(string $field, $value): RequestInterface;

    public function setDetails(array $data): RequestInterface;

    public function getDetails(): array;
}