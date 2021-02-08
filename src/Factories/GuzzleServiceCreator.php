<?php


namespace Chaser\Factories;

use Chaser\Interfaces\ApiInterface;
use Chaser\Services\ApiService;
use GuzzleHttp\Client;

class GuzzleServiceCreator extends ApiSenderFactory
{

    public function create(): ApiInterface
    {
        $client = new Client([
            'base_uri' => 'http://testapi.ru',
            'timeout'  => 2.0,
        ]);

        return  new ApiService($client);
    }
}