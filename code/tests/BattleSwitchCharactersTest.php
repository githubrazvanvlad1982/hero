<?php


namespace Tests;


use Hero\Domain\Battle;
use PHPUnit\Framework\TestCase;

class BattleSwitchCharactersTest extends TestCase
{
    public function test(): void
    {
        $character1 = CharacterFactory::createCharacter([
            'health' => 100,
            'strength' => 80,
        ]);
        $character2 = CharacterFactory::createCharacter([
                'health' => 100,
                'strength' => 70,
        ]);

        $battle = new Battle();
        $battle->battle($character1, $character2, 2);

        self::assertNotEquals($character1->getHealth(), 100);
        self::assertEquals($character1->getStrength(), 80);
        self::assertNotEquals($character2->getHealth(), 100);
        self::assertEquals($character2->getStrength(), 70);
    }
}