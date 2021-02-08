<?php

namespace Tests\Unit;

use Chaser\Factories\GuzzleTestServiceCreator;
use Chaser\Interfaces\ApiInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class BaseTestApi extends TestCase
{
    /**
     * @var ApiInterface
     */
    protected $client;

    protected function setMockedServer(Response $response)
    {
        $mock = new MockHandler([
            $response
        ]);

        $this->client = (new GuzzleTestServiceCreator($mock))->create();
    }
}