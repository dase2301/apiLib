<?php

namespace Chaser\Responses\GetInfo;

use Chaser\Responses\LibraryResponse;

class GetInfoResponse extends LibraryResponse
{
    private int $active;

    private bool $blocked;

    private string $name;

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
        array $permissions
    )
    {
        $this->active = $active;
        $this->blocked = $blocked;
        $this->name = $name;
        $this->permissions = $permissions;
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
}