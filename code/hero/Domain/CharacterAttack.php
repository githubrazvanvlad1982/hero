<?php
declare(strict_types=1);

namespace Hero\Domain;


use Exception;

class CharacterAttack implements CharacterAttackInterface
{
    /**
     * @throws Exception
     */
    public function apply(Fight $fight): void
    {
        $damage = $fight->getAttacker()->getStrength() - $fight->getDefender()->getDefence();
        $damage = $damage >= 0 ? $damage : 0;
        $fight->setAppliedDamage($damage);
        $fight->setDamage($damage);
    }

    /**
     * @throws Exception
     */
    public function applySkills(Fight $fight, int &$damage): void
    {
        foreach ($fight->getAttacker()->getAttackingSkills() as $skill) {
            if ($skill->canApply()) {
                $skill->apply($damage);
                $fight->addAttackerAppliedSkill($skill);
                return;
            }
        }
    }
}