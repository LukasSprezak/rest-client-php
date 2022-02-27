<?php
declare(strict_types=1);
namespace RestClient\Provider;

use RestClient\Http\Request\RequestInterface;
use RestClient\Http\Response\ResponseInterface;

interface ClientInterface
{
    public function sendRequest(RequestInterface $request, ResponseInterface $response);
}