<?php


namespace Tests\Unit;


use Chaser\Requests\UpdateInfoRequest;
use Chaser\Responses\GetInfo\GetInfoResponse;
use GuzzleHttp\Psr7\Response;

class UpdateInfoTest extends BaseTestApi
{
    public function testSuccess()
    {
        $this->setMockedServer(
            new Response(200, [], json_encode(['status' => 'ok'], JSON_THROW_ON_ERROR))
        );

        /**
         * @var GetInfoResponse
         */
        $result = $this->makeRequest();

        self::assertEquals('ok', $result->getStatus());
    }

    private function makeRequest()
    {
        return $this->client->updateInfo((new UpdateInfoRequest(
        1,
        true,
        '',
        [],
        '',
        1
        )));
    }
}