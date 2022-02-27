<?php
declare(strict_types=1);
namespace RestClient\Http\Request;

class Request implements RequestInterface
{
    private const SEPARATOR = '/';
    private const JSON = 'application/json';

    private string $host;
    private string $method = self::GET;
    private string $uri;
    private array $headers = [];
    private array $data = [];

    public function __construct(string $host)
    {
        $this->setHost($host);
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): RequestInterface
    {
        $host = trim($host);
        $url = parse_url($host);
        $scheme = strtolower($url['scheme']) ?? '';

        $allowedProtocols = ['http', 'https'];

        if (!in_array(strtolower($url['scheme']), $allowedProtocols)) {
            throw new \InvalidArgumentException(sprintf("Wrong scheme '%s'", $scheme));
        }

        $this->host = $host;
        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): RequestInterface
    {
        $this->method = strtoupper(trim($method));

        return $this;
    }

    public function getUri(): string
    {
        return $this->uri ?? self::SEPARATOR;
    }

    public function setUri(string $uri): RequestInterface
    {
        if (empty($uri)) {
            throw new \InvalidArgumentException('Not stated URI.');
        }

        $this->uri = implode(self::SEPARATOR, array_filter(explode(self::SEPARATOR, trim($uri))) );

        if (null === $this->uri) {
            $this->uri = self::SEPARATOR;

        } elseif (self::SEPARATOR !== $this->uri[0]) {
            $this->uri = self::SEPARATOR . $this->uri;
        }

        return $this;
    }

    public function addHeaders(array $headers): RequestInterface|static
    {
        if (empty($headers)) {
            throw new \InvalidArgumentException('Empty array passed.');
        }

        $this->headers = $headers;
        return $this;
    }

    public function getHeaders(): array
    {
        $this->headers = array_change_key_case($this->headers, CASE_LOWER);

        if (!isset($this->headers['accept'])) {
            $this->headers['accept'] = self::JSON;
        }

        return $this->headers;
    }

    public function getDetails(): array
    {
        return $this->data;
    }

    public function addDetails(string $field, $value): RequestInterface
    {
        $this->data[$field] = $value;
        return $this;
    }

    public function setDetails(array $data): RequestInterface
    {
        $this->data = $data;
        return $this;
    }
}