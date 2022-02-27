<?php
declare(strict_types=1);
namespace RestClient\Http\Response;

interface ResponseInterface
{
    public function getStatusCode(): int;
    public function setStatusCode(int $statusCode): ResponseInterface;

    public function getHeaders(): array;
    public function setHeaders(array $headers): ResponseInterface;

    public function getContent(): string;
    public function setContent(string $content): ResponseInterface;

    public function getContentType(): string;

    public function getHeader(string $headerName, $default = null): string;

    public function successes(string $code): bool;
}
