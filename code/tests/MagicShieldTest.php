<?php
declare(strict_types=1);

namespace Tests;


use Hero\Domain\Skill\MagicShieldSkill;
use PHPUnit\Framework\TestCase;

class MagicShieldTest extends TestCase
{
    public function testApply(): void
    {
        $damage = 20;
        (new MagicShieldSkill())->apply($damage);

        self::assertEquals(10, $damage);
    }
}
