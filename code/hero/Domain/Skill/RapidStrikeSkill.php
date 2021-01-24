<?php
declare(strict_types=1);

namespace Hero\Domain\Skill;

class RapidStrikeSkill extends AttackingSkill
{

    public function __construct()
    {
        parent::__construct(10);
    }

    public function apply(int &$damage): void
    {
        $damage *= 2;
    }
}