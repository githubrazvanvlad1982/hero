<?php
declare(strict_types=1);

namespace Tests;


use Hero\Domain\Skill\MagicShieldSkill;
use Hero\Domain\Skill\RapidStrikeSkill;
use PHPUnit\Framework\TestCase;

class CharacterSkillsGettersTest extends TestCase
{
    public function testSkillGetters():void
    {
        $defendingSkill = new MagicShieldSkill();
        $attackingSkill = new RapidStrikeSkill();

        $character = CharacterFactory::createCharacter();

        $character->addSkill($defendingSkill);
        $character->addSkill($attackingSkill);


        self::assertEquals($defendingSkill, $character->getDefendingSkills()[0]);
        self::assertEquals($attackingSkill, $character->getAttackingSkills()[0]);
    }
}