<?php
declare(strict_types=1);

namespace Tests;

use Exception;
use Hero\Domain\Battle;
use Hero\Domain\Skill\MagicShieldSkill;
use Hero\Domain\Skill\RapidStrikeSkill;
use PHPUnit\Framework\TestCase;

class BattleApplySkillsTest extends TestCase
{

    /**
     * @param BattleTest $testBattle
     * @throws Exception
     */
    public function testAttackerAttackingSkillsAreApplied(): void
    {
        $attacker = CharacterFactory::createCharacter([
            'strength' => 70
        ]);

        $defender = CharacterFactory::createCharacter([
            'health' => 100,
            'defence' => 50
        ]);

        $rapidStrikeSkill = $this->createPartialMock(RapidStrikeSkill::class, ['canApply']);
        $rapidStrikeSkill->method('canApply')->willReturn(true);

        $magicShieldSkill = $this->createPartialMock(MagicShieldSkill::class, ['canApply']);
        $magicShieldSkill->method('canApply')->willReturn(true);


        $attacker->addSkill($rapidStrikeSkill);
        $attacker->addSkill($magicShieldSkill);

        $battle = new Battle();

        $battle->fight($attacker, $defender);

       self::assertEquals(60, $defender->getHealth());
    }

    /**
     * @throws Exception
     */
    public function testCharacterWithHigherSpeedStartsTheBattle(): void
    {
        $c1 = CharacterFactory::createCharacter([
            'speed' => 10
        ]);

        $c2 = CharacterFactory::createCharacter([
            'speed' => 20
        ]);

        $battle = new Battle();

        self::assertEquals($c2, $battle->getStartingCharacter($c1, $c2));
    }

    /**
     * @throws Exception
     */
    public function testDefenderDefendingSkillsAreApplied(): void
    {
        $attacker = CharacterFactory::createCharacter([
            'strength' => 70
        ]);

        $defender = CharacterFactory::createCharacter([
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
    public function testOnlyFirstSkillThatCanBeAppliedWillBeApplied(): void
    {
        $skill1 = $this->createMock(RapidStrikeSkill::class);
        $skill1
            ->expects(self::never())
            ->method('apply');

        $skill1->method('canApply')
            ->willReturn(false);

        $skill2 = $this->createMock(RapidStrikeSkill::class);
        $skill2
            ->expects(self::once())
            ->method('apply');
        $skill2
            ->method('canApply')
            ->willReturn(true);

        $skill3 = $this->createMock(RapidStrikeSkill::class);
        $skill3
            ->expects(self::never())
            ->method('apply');

        $skill3->method('canApply')
            ->willReturn(true);


        $attacker = CharacterFactory::createCharacter();
        $attacker->addSkill($skill1);
        $attacker->addSkill($skill2);
        $attacker->addSkill($skill3);

        $battle = new Battle();
        $battle->fight($attacker, CharacterFactory::createCharacter());
    }

}