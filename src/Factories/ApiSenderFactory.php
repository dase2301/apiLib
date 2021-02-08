<?php

namespace Chaser\Factories;

use Chaser\Interfaces\ApiInterface;

abstract class ApiSenderFactory
{
   abstract public function create(): ApiInterface;
}