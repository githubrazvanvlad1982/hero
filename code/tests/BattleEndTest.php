<?php
declare(strict_types=1);

namespace Tests;


use Exception;
use Hero\Domain\Battle;
use PHPUnit\Framework\TestCase;

class BattleEndTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testBattleEndsAfterANumberOfSteps(): void
    {
        $attacker = CharacterFactory::createCharacter([
            'strength' => 10,
            'damage' => 50,
        ]);

        $defender = CharacterFactory::createCharacter([
            'strength' => 10,
            'damage' => 50,
        ]);

        $battle = new Battle();

        $fights = $battle->battle($attacker, $defender, 20);

        self::assertCount(20, $fights);
    }

    /**
     * @throws Exception
     */
    public function testBattleEndsWhenDefenderHealthIsDepleted(): void
    {
        $attacker = CharacterFactory::createCharacter([
            'strength' => 80,
        ]);

        $defender = CharacterFactory::createCharacter([
            'defence' => 70,
            'health' => 20,
        ]);

        $battle = new Battle();

        $fights = $battle->battle($attacker, $defender, 20);

        self::assertNotCount(20, $fights);
    }
}