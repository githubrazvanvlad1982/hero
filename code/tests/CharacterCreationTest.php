<?php

namespace Tests;

use Exception;
use Hero\Domain\Character;
use Hero\Domain\Skill\RapidStrikeSkill;
use PHPUnit\Framework\TestCase;

class CharacterCreationTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCharacterPropertyAssignment(): void
    {
        $character = new Character(
            'name',
            70,
            75,
            45,
            40,
            10
        );

        self::assertEquals('name', $character->getName());
        self::assertEquals(70, $character->getHealth());
        self::assertEquals(75, $character->getStrength());
        self::assertEquals(45, $character->getDefence());
        self::assertEquals(40, $character->getSpeed());
        self::assertEquals(10, $character->getLuck());

    }

    public function testCharacterSkillsAssignment(): void
    {
        $character = SkilledCharacterFactory::createCharacter();
        $rapidStrikeSkill = new RapidStrikeSkill();
        $character
            ->addSkill($rapidStrikeSkill);

        self::assertEquals($rapidStrikeSkill, $character->getAttackingSkills()[0]);

    }
}

