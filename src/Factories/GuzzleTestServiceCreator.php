<?php


namespace Chaser\Factories;

use Chaser\Interfaces\ApiInterface;
use Chaser\Services\ApiService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

/**
 * Class GuzzleTestServiceCreator
 * @package Chaser\Factories
 */
class GuzzleTestServiceCreator extends ApiSenderFactory
{
    private MockHandler $mockHandler;

    public function __construct(MockHandler $mockHandler)
    {
        $this->mockHandler = $mockHandler;
    }
    public function create(): ApiInterface
    {
        $handlerStack = HandlerStack::create($this->mockHandler);
        $client = new Client(['handler' => $handlerStack]);

        return new ApiService($client);
    }
}