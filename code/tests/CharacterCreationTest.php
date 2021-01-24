<?php

namespace Tests;

use Exception;
use Hero\Domain\Character;
use Hero\Domain\Skill\MagicShieldSkill;
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
            70,
            75,
            45,
            40,
            10
        );

        self::assertEquals(70, $character->getHealth());
        self::assertEquals(75, $character->getStrength());
        self::assertEquals(45, $character->getDefence());
        self::assertEquals(40, $character->getSpeed());
        self::assertEquals(10, $character->getLuck());

    }

    public function testCharacterSkillsAssignment(): void
    {
        $character = CharacterFactory::createCharacter();
        $rapidStrikeSkill = new RapidStrikeSkill();
        $character
            ->addSkill($rapidStrikeSkill);

        self::assertEquals($rapidStrikeSkill, $character->getAttackingSkills()[0]);

    }
}

