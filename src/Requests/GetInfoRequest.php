<?php

namespace Chaser\Requests;

class GetInfoRequest
{
    private string $username;

    private string $token;

    public function __construct(string $username, string $token)
    {
        $this->token = $token;
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}