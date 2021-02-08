<?php

namespace Chaser\Services;

use Chaser\Exceptions\BadRequestException;
use Chaser\Interfaces\ApiInterface;
use Chaser\Requests\AuthRequest;
use Chaser\Requests\GetInfoRequest;
use Chaser\Requests\UpdateInfoRequest;
use Chaser\Responses\Auth\AuthSuccessResponse;
use Chaser\Responses\GetInfo\GetInfoResponse;
use Chaser\Responses\LibraryResponse;
use ElisDN\Hydrator\Hydrator;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class ApiService implements ApiInterface
{
    private Hydrator $hydrator;

    private const AUTH_URI = '/auth';

    private const GET_INFO_URI = '/get-user';

    private const UPDATE_INFO_URI = '/user';

    /**
     * @var int
     */
    private const DEFAULT_TIMEOUT = 10;

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->hydrator = new Hydrator();
    }

    public function auth(AuthRequest $request): LibraryResponse
    {
        $response = $this->client->request('GET', self::AUTH_URI, [
            'query' => [
                'login' => $request->getLogin(),
                'pass' => $request->getPass(),
            ]
        ]);

       return $this->catchResponse($response, AuthSuccessResponse::class);
    }

    public function getInfo(GetInfoRequest $request)
    {
        $response = $this->client->request('GET', self::GET_INFO_URI . '/' . $request->getUsername(), [
            'query' => [
                'token' => $request->getToken(),
            ]
        ]);

        return $this->catchResponse($response, GetInfoResponse::class);
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        $response = $this->client->request('POST', self::UPDATE_INFO_URI . '/' . $request->getUserId(), [
            'query' => [
                'token' => $request->getToken(),
            ],
            'content-type' => 'application/json',
            'json' => [
                'name' => $request->getName()
            ]
        ]);

        return $this->catchResponse($response, LibraryResponse::class);
    }

    private function catchResponse(ResponseInterface $response, string $classNameResponse)
    {
        return match ($response->getStatusCode()) {
            200 => $this->prepareSuccessResponse($response, $classNameResponse),
            // need to catch guzzle exceptions and catch other httpCodes here.
        };
    }

    private function prepareSuccessResponse(ResponseInterface $response, $responseClassName): LibraryResponse
    {
         return $this->hydrator->hydrate(
            $responseClassName,
             json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR)
        );
    }

    private function catchBadRequestError(ResponseInterface $response): void
    {
        throw new BadRequestException(
            json_decode(
                $response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR
            )['message'] ?? 'Bad Request'
        );
    }
}