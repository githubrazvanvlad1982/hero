<?php
declare(strict_types=1);

namespace Tests;

use Exception;
use Hero\Domain\Battle;
use Hero\Domain\Character;
use Hero\Domain\Skill\MagicShieldSkill;
use Hero\Domain\Skill\RapidStrikeSkill;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BattleTest extends TestCase
{

    public function testWhenCharactersHaveSameStraightCharacterWithBiggerLuckStarts(): void
    {
        $c1 = CharacterFactory::createCharacter([
            'speed' =>  10,
            'luck' => 20
        ]);

        $c2 = CharacterFactory::createCharacter([
            'speed' =>  10,
            'luck' => 30
        ]);
        $battle = new Battle();
        self::assertEquals($c2,$battle->getStartingCharacter($c1, $c2));
    }

    /**
     * @throws Exception
     */
    public function testIfDefenderIsLuckyThenHealthIsNotChangedAfterFight(): void
    {
        $attacker = CharacterFactory::createCharacter();

        /** @var Character | MockObject $defender */
        $defender = $this->getMockBuilder(Character::class)
            ->setConstructorArgs( ['name',70, 75, 45, 40, 10])
            ->setMethods(['isLucky'])
            ->getMock();

        $defender->method('isLucky')
            ->willReturn(true);

        $battle = new Battle();
        $battle->fight($attacker, $defender);
        self::assertEquals( 70,$defender->getHealth());
    }

    /**
     * @throws Exception
     */
    public function testFightStrengthGraterThenDefence(): void
    {
        $attacker = CharacterFactory::createCharacter([
            'strength' =>  40,
        ]);

        $defender = CharacterFactory::createCharacter([
            'defence' =>  30,
            'health' => 40
        ]);
        $battle = new Battle();

        $battle->fight($attacker, $defender);

        self::assertEquals(30, $defender->getHealth());
    }

    /**
     * @throws Exception
     */
    public function testDefenderDefendingSkillsAreApplied(): void
    {
        $attacker = CharacterFactory::createCharacter([
            'strength' => 70
        ]);

        $defender = SkilledCharacterFactory::createCharacter([
            'health' => 100,
            'defence' => 50
        ]);

        $rapidStrikeSkill = $this->createPartialMock(RapidStrikeSkill::class, ['canApply']);
        $rapidStrikeSkill->method('canApply')->willReturn(true);

        $magicShieldSkill = $this->createPartialMock(MagicShieldSkill::class, ['canApply']);
        $magicShieldSkill->method('canApply')->willReturn(true);

        $defender->addSkill($rapidStrikeSkill);
        $defender->addSkill($magicShieldSkill);

        $battle = new Battle();

        $battle->fight($attacker, $defender);

        self::assertEquals(90, $defender->getHealth());
    }


    /**
     * @throws Exception
     */
    public function testWhenAttackerStrengthIsEqualToDefenderDefenceThenDefenderHealthIsNotChanged(): void
    {
        $attacker = CharacterFactory::createCharacter([
            'strength' =>  40,
        ]);

        $defender = CharacterFactory::createCharacter([
            'defence' =>  40,
            'health' => 40
        ]);
        $battle = new Battle();
        $battle->fight($attacker, $defender);

        self::assertEquals(40, $defender->getHealth());
    }

    /**
     * @throws Exception
     */
    public function testWhenAttackerStrengthIsLessThenDefenderDefenceThenDefenderHealthIsNotChanged(): void
    {
        $attacker = CharacterFactory::createCharacter([
            'strength' =>  30,
        ]);

        $defender = CharacterFactory::createCharacter([
            'defence' =>  40,
            'health' => 40
        ]);
        $battle = new Battle();
        $battle->fight($attacker, $defender);

        self::assertEquals(40, $defender->getHealth());
    }
}

