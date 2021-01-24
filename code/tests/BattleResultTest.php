<?php
declare(strict_types=1);

namespace Tests;


use Exception;
use Hero\Domain\Battle;
use PHPUnit\Framework\TestCase;

class BattleResultTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testBattleResult(): void
    {
        $battle = new Battle();
        $result = $battle->battle(
            CharacterFactory::createCharacter(),
            CharacterFactory::createCharacter(),
            10
        );

        self::assertNotNull($result);
    }
}