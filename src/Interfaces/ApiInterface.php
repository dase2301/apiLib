<?php

namespace Chaser\Interfaces;

use Chaser\Requests\AuthRequest;
use Chaser\Requests\GetInfoRequest;
use Chaser\Requests\UpdateInfoRequest;
use Chaser\Responses\Auth\AuthSuccessResponse;
use Chaser\Responses\LibraryResponse;

/**
 * Interfaces ApiInterface
 */
interface ApiInterface
{
    public function auth(AuthRequest $request): LibraryResponse;

    public function getInfo(GetInfoRequest $request);

    public function updateInfo(UpdateInfoRequest $request);
}