<?php


namespace Chaser\Requests;


class AuthRequest
{
    private string $login;

    private string $pass;

    public function __construct(string $login, string $pass)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }
    /**
     * @return string
     */
    public function getPass(): string
    {
        return $this->pass;
    }
}