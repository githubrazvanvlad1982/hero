<?php
declare(strict_types=1);

namespace Hero\Domain;

use Exception;
use function DeepCopy\deep_copy;

class Battle
{
    /**
     * @throws Exception
     */
    public function battle(Character $character1, Character $character2, $numberOfTurns): array
    {
        $attacker = $this->getStartingCharacter($character1, $character2);
        $defender = $character1 === $attacker ? $character2 : $character1;
        $fights = [];

        for ($turn = 1;  $turn <= $numberOfTurns; $turn++) {
            $fight = $this->fight($attacker, $defender);
            $fight->setTurn($turn);

            $fights[] = deep_copy($fight);
            if ($defender->getHealth() < 1) {
                break;
            }
            list($attacker, $defender) = $this->switchCharacters($attacker, $defender);
        }

        return $fights;
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
    public function fight(Character $attacker, Character $defender): Fight
    {
        $fight = new Fight($attacker, $defender);
        CharacterAttackFactory::create($attacker)->apply($fight);
        CharacterDefendFactory::create($defender)->apply($fight);


        $health = $defender->getHealth() - $fight->getDamage();
        $health = $health > 0 ? $health : 0;

        $defender->setHealth($health);

        return $fight;
    }

    public function switchCharacters(Character $attacker, Character $defender): array
    {
        $tmp = $attacker;
        $attacker = $defender;
        $defender = $tmp;

        return [$attacker, $defender];
    }
}