<?php
declare(strict_types=1);
namespace RestClient\Http\Response;

use RestClient\Exception\ResponseException;

class Response implements ResponseInterface
{
    private const SUCCESS = 200;
    private const EXPLODE_COUNT = 1;

    private string $content = '';
    private int $statusCode = 0;
    private array $headers = [];

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): ResponseInterface
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): ResponseInterface
    {
        $this->headers = array_change_key_case($headers, CASE_LOWER);
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): ResponseInterface
    {
        $this->content = $content;
        return $this;
    }

    public function getContentType(): string
    {
        $contentType = $this->getHeader('content-type');

        if (!$contentType) {
            return (string)$contentType;
        }

        $explode = explode(';', $contentType);

        if (count($explode) > self::EXPLODE_COUNT) {
            return $explode[0];
        }

        return $contentType;
    }

    public function getHeader(string $headerName, $default = null): string
    {
        $headerName = strtolower($headerName);

        try {
            if (isset($this->headers[$headerName])) {
                return (string)$this->headers[$headerName];
            }

        } catch (ResponseException $exception) {
            exit($exception->getMessage());
        }

        return (string)$default;
    }

    public function successes($code = null ): bool
    {
        if (!is_null($code) ) {
            return $this->getStatusCode() === $code;
        }

        return $this->getStatusCode() === self::SUCCESS;
    }
}