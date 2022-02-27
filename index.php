<?php
declare(strict_types=1);
include_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use RestClient\Exception\TransportException;
use RestClient\Http\Request\Request;
use RestClient\Http\Request\RequestInterface;
use RestClient\Http\Response\Response;
use RestClient\Provider\Curl;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$request = new Request('https://jsonplaceholder.typicode.com');

$request
    ->setUri('/posts')
    ->addHeaders([
        'Accept' => 'application/json',
    ])
;

$request
    ->setUri('/posts/1')
    ->setMethod(RequestInterface::DELETE)
    ->addHeaders([
        'Accept' => 'application/json',
    ])
;

$request
    ->setUri('/posts/1')
    ->setMethod(RequestInterface::PATCH)
    ->addHeaders([
        'Accept' => 'application/json',
    ])
    ->addDetails('title', 'test')
;

$request->setUri('/posts')
    ->setMethod(RequestInterface::POST)
    ->addDetails('username', 'admin')
    ->addDetails('password', 'admin')
;

$response = new Response();
$client = new Curl();
try {
    $client->sendRequest($request, $response);
} catch (JsonException|TransportException $exception) {}
