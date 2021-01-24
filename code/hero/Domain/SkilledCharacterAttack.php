<?php
declare(strict_types=1);

namespace Hero\Domain;


use Exception;

class SkilledCharacterAttack extends CharacterAttack
{
    public function apply(Fight $fight): void
    {
        parent::apply($fight);
        $damage = $fight->getDamage();

        $this->applySkills($fight, $damage);
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