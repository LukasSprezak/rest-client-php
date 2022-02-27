<?php
declare(strict_types=1);
namespace RestClient\Provider;

use RestClient\Exception\TransportException;
use RestClient\Http\Request\RequestInterface;
use RestClient\Http\Response\ResponseInterface;

class Curl implements ClientInterface
{
    private \CurlHandle $curl;
    private string $agent = 'RestClient';

    public function sendRequest(RequestInterface $request, ResponseInterface $response): bool|string
    {
        $this->curl = curl_init();
        curl_setopt_array($this->curl, [
            CURLOPT_URL => $request->getHost() . $request->getUri(),
            CURLOPT_CUSTOMREQUEST => strtoupper(trim($request->getMethod())),
            CURLOPT_HTTPHEADER => $request->getHeaders(),
            CURLOPT_USERAGENT => $this->agent,
        ]);

        if (RequestInterface::POST === strtoupper(trim($request->getMethod())) ) {
            curl_setopt($this->curl, CURLOPT_POST, true);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($_POST));
        }

        $responseResult = curl_exec($this->curl);
        $errno = curl_errno($this->curl);
        $errorMessage = curl_error($this->curl);
        curl_close($this->curl);

        if ($errno) {
            throw new TransportException($errorMessage, $errno);
        }

        return $responseResult;
    }
}
