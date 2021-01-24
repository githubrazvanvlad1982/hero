<?php
declare(strict_types=1);

namespace Tests;


use Exception;
use Hero\Domain\Battle;
use Hero\Domain\Character;
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

    public function testBattleResultSchema(): void
    {
        $battle = new Battle();
        $result = $battle->battle(
            CharacterFactory::createCharacter(),
            CharacterFactory::createCharacter(),
            10
        );

        self::assertCount(2,$result->characters);
        self::assertNotNull($result->stepsNumber);
        self::assertNotNull($result->startingCharacter);
        self::assertNotNull($result->steps);

        foreach ($result->steps as $step) {
            self::assertNotNull($step->step);
            self::assertNotNull($step->attacker);
            self::assertNotNull($step->defender);
//            self::assertNotNull($step->defenderUsedSkills);
//            self::assertNotNull($step->attackerUsedSkills);
            self::assertNotNull($step->damage);
        }
    }
}