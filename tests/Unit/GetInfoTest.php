<?php

namespace Tests\Unit;

use Chaser\Requests\GetInfoRequest;
use Chaser\Responses\GetInfo\GetInfoResponse;
use GuzzleHttp\Psr7\Response;

class GetInfoTest extends BaseTestApi
{
    private $successResponse = [
        'active' => 1,
        'blocked' => false,
        'name' => 'Petrovi4',
        'permissions' => [
            [
                'id' => 1,
                'permission' => 'comment',
            ],
            [
                'id' => 2,
                'permission' => 'anotherPermission'
            ]
        ]
    ];

    public function testSuccess()
    {
        $this->setMockedServer(
            new Response(200, [], json_encode($this->successResponse, JSON_THROW_ON_ERROR))
        );

        /**
         * @var GetInfoResponse
         */
        $result = $this->makeRequest();

        self::assertFalse($result->isBlocked());
        self::assertEquals($this->successResponse['active'], $result->getActive());
        self::assertEquals($this->successResponse['name'], $result->getName());
    }

    private function makeRequest()
    {
        return $this->client->getInfo((new GetInfoRequest('petrovich', 'token')));
    }
}