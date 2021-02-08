<?php

namespace Tests\Unit;

use Chaser\Requests\AuthRequest;
use Chaser\Responses\Auth\AuthSuccessResponse;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;

class AuthTest extends BaseTestApi
{
    private array $successResponseBody = [
        'status' => 'ok',
        'token' => 'dsfdsfsdfsdfdsfdsfdsfdsfds'
    ];

    public function testSuccess()
    {
        $this->setMockedServer(
            new Response(200, [], json_encode($this->successResponseBody, JSON_THROW_ON_ERROR))
        );

        /**
         * @var AuthSuccessResponse
         */
        $response = $this->makeRequest();

        self::assertEquals('ok', $response->getStatus());
        self::assertEquals($this->successResponseBody['token'], $response->getToken());

    }

    public function testFailedCredit()
    {
        $this->expectException(ClientException::class);

        $this->setMockedServer(
            new Response(401, [])
        );

        /**
         * @var AuthSuccessResponse
         */
        $result = $this->makeRequest();
    }

    private function makeRequest()
    {
        return $this->client->auth((new AuthRequest('login', 'pass')));
    }
}