<?php
declare(strict_types=1);

namespace Hero\Domain;

use Hero\Domain\Skill\Skill;
use Exception;
use stdClass;

class Battle
{
    /**
     * @throws Exception
     */
    public function battle(Character $attacker, Character $defender, $numberOfSteps): stdClass
    {
        $result = new stdClass();
        $result->characters = [
            $attacker, $defender
        ];

        $result->stepsNumber = $numberOfSteps;
        $result->startingCharacter = $attacker;
        $result->steps = [];


        $stepIndex = 1;
        while(!$this->hasEnded($numberOfSteps, $stepIndex, $defender->getHealth())){
            $stepIndex++;

            $fightResult = $this->fight($attacker, $defender);
            $fightResult->step = $stepIndex;
            $result->steps[] = $fightResult;
        }

        return $result;

    }

    public function getStartingCharacter(Character $character1, Character $character2): Character
    {
        if ($character1->getSpeed() === $character2->getSpeed()) {
            return $character1->getLuck() > $character2->getLuck()
                ? $character1
                : $character2;
        }

        return $character1->getSpeed() > $character2->getSpeed()
            ? $character1
            : $character2;
    }

    /**
     * @throws Exception
     */
    public function fight(Character $attacker, Character $defender): stdClass
    {
        $fightResult = new \stdClass();
        $fightResult->attacker = $attacker;
        $fightResult->defender = $defender;
        $fightResult->damage = 0;
        $fightResult->defenderWasLucy = false;

        $characterAttack = new CharacterAttack();
        $result = $characterAttack->apply($attacker, $defender, $fightResult);


        $this->applySkills($defender->getDefendingSkills(), $result->damage, $fightResult);

        $health = $defender->getHealth() - $result->damage;
        $health = $health > 0 ? $health : 0;

        $defender->setHealth($health);

        return $fightResult;
    }

    /**
     * @param Skill[] $skills
     * @param int $damage
     * @throws Exception
     */
    public function applySkills(array $skills, int &$damage): void
    {
        foreach ($skills as $skill) {
            if ($skill->canApply()) {
                $skill->apply($damage);
                return;
            }
        }
    }


    private function hasEnded(int $numberOfSteps, int $step, int $getHealth): bool
    {
        return ($getHealth < 1 || $step > $numberOfSteps);
    }
}