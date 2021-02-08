<?php


namespace Chaser\Requests;


class UpdateInfoRequest
{
    private int $active;

    private bool $blocked;

    private string $name;

    private string $token;

    private string $userId;

    /**
     * better to take object of object but we need a recursive hydrator to create this.
     *
     * @var array
     */
    private array $permissions;

    /**
     * looks weird but not enough time to create my own hydrator.
     *
     *
     * GetInfoResponse constructor.
     * @param int $active
     * @param bool $blocked
     * @param string $name
     * @param array $permissions
     */
    public function __construct(
        int $active,
        bool $blocked,
        string $name,
        array $permissions,
        string $token,
        int $userId
    )
    {
        $this->active = $active;
        $this->blocked = $blocked;
        $this->name = $name;
        $this->permissions = $permissions;
        $this->token = $token;
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isBlocked(): bool
    {
        return $this->blocked;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return int|string
     */
    public function getUserId(): int|string
    {
        return $this->userId;
    }
}