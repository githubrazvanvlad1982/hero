<?php
declare(strict_types=1);

namespace Hero\Domain\Skill;


use Exception;

abstract class Skill
{
    public function __construct(int $chance)
    {
        $this->chance = $chance;
    }

    /** @var int */
    private $chance;

    /**
     * @throws Exception
     */
    public function canApply(): bool
    {
        return random_int(1,100) <= $this->chance;
    }


    abstract public function apply(int &$damage): void;
}