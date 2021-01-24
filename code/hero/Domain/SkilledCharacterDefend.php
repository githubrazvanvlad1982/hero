<?php
declare(strict_types=1);

namespace Hero\Domain;


use Exception;
use Hero\Domain\Skill\Skill;

class SkilledCharacterDefend extends CharacterDefend
{
    /**
     * @throws Exception
     */
    public function apply(Fight $fight): void
    {
        parent::apply($fight);
        if ($fight->getIsLuckyApplied()) {
            return;
        }

        $damage = $fight->getDamage();
        $this->applySkills($fight, $damage);

        $fight->setDamage($damage);
    }

    /**
     * @param Skill[] $skills
     * @param int $damage
     * @throws Exception
     */
    public function applySkills(Fight $fight, int &$damage): void
    {
        foreach ($fight->getDefender()->getDefendingSkills() as $skill) {
            if ($skill->canApply()) {
                $skill->apply($damage);
                $fight->addDefenderAppliedSkill($skill);
                return;
            }
        }
    }
}