<?php

namespace Chaser\Responses\Auth;

use Chaser\Responses\LibraryResponse;

/**
 * Class AuthSuccessResponse
 * @package Chaser\Responses\Auth
 */
class AuthSuccessResponse extends LibraryResponse
{
    private string $token;

    /**
     * AuthSuccessResponse constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}