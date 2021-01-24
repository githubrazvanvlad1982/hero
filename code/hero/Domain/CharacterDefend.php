<?php
declare(strict_types=1);

namespace Hero\Domain;

use Exception;

class CharacterDefend implements CharacterDefendInterface
{
    /**
     * @throws Exception
     */
    public function apply(Fight $fight): void
    {
        if ($fight->getDefender()->isLucky()) {
            $fight->setDamage(0);
            $fight->setIsLuckyApplied(true);
            return;
        }

        $damage = $fight->getDamage();
        $fight->setDamage($damage);
    }
}