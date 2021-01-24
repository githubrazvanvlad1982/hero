<?php
declare(strict_types=1);

namespace Tests;


use Hero\Domain\Skill\RapidStrikeSkill;
use PHPUnit\Framework\TestCase;

class RapidStrikeSkillTest extends TestCase
{
    public function testApply(): void
    {
        $damage = 20;
        (new RapidStrikeSkill())->apply($damage);

        self::assertEquals(40, $damage);
    }
}