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
        $numberOfSteps = 10;
        $attacker = CharacterFactory::createCharacter();
        $defender = CharacterFactory::createCharacter();

        $battle = $this->createPartialMock(Battle::class, ['fight']);
        $battle->expects(self::exactly(10))
            ->method('fight');

        $battle->battle($attacker, $defender, $numberOfSteps);
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

        $battle  = $this->createPartialMock(Battle::class, ['applySkills']);
        $battle->expects(self::exactly(4))
            ->method('applySkills')
            ->willReturn(null);

        $battle->battle($attacker, $defender, 20);
        self::assertEquals(0, $defender->getHealth());
    }
}