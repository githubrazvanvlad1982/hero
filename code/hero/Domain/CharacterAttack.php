<?php
declare(strict_types=1);

namespace Hero\Domain;


use Hero\Domain\Skill\Skill;

class CharacterAttack
{
    public function apply($attacker, $defender, $fightResult): void
    {
        if ($defender->isLucky()) {
            $fightResult->defenderWasLucy = true;
        }

        $damage = $attacker->getStrength() - $defender->getDefence();
        $damage = $damage > 0 ? $damage : 0;
        $fightResult->damage = $damage;

        $this->applySkills($attacker->getAttackingSkills(), $damage, $fightResult);
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
}