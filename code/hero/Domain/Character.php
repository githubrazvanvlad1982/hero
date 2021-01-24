<?php
declare(strict_types=1);

namespace Hero\Domain;

use Exception;

class Character
{
    /** @var string  */
    private $name;

    /** @var int */
    private $health;

    /** @var int */
    private $strength;

    /** @var int */
    private $defence;

    /** @var int */
    private $speed;

    /** @var int */
    private $luck;

    public function __construct(
        string $name,
        int $health,
        int $strength,
        int $defence,
        int $speed,
        int $luck
    )
    {
        $this->name = $name;
        $this->health = $health;
        $this->strength = $strength;
        $this->defence = $defence;
        $this->speed = $speed;
        $this->luck = $luck;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    public function setHealth(int $health): void
    {
        $health = $health >= 0 ? $health : 0;
        $health = $health <= 100 ? $health : 100;

        $this->health = $health;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @throws Exception
     */
    public function isLucky(): bool
    {
       return random_int(1, 100) <= $this->luck;
    }


}