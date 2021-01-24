<?php
declare(strict_types=1);

namespace Hero\Domain\Skill;

class MagicShieldSkill extends DefendingSkill
{
    public function __construct()
    {
        parent::__construct(20);
    }

    public function apply(int &$damage): void
    {
        $damage = (int) round($damage / 2);
    }
}