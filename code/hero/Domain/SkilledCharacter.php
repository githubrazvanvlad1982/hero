<?php
declare(strict_types=1);

namespace Hero\Domain;



use Hero\Domain\Skill\AttackingSkill;
use Hero\Domain\Skill\DefendingSkill;
use Hero\Domain\Skill\Skill;

class SkilledCharacter extends Character
{
    /** @var array $defendingSkill */
    private $skill = [];

    public function __construct(string $name, int $health, int $strength, int $defence, int $speed, int $luck,array $skills)
    {
        parent::__construct($name, $health, $strength, $defence, $speed, $luck);
        foreach ($skills as $skill) {
            $this->addSkill($skill);
        }
    }

    public function addSkill(Skill $skill): Character
    {
        $this->skill[] = $skill;

        return $this;
    }

    /**
     * @return AttackingSkill[]
     */
    public function getAttackingSkills(): array
    {
        return $this->getSkillsByClass(AttackingSkill::class);
    }

    /**
     * @return AttackingSkill[]
     */
    public function getDefendingSkills(): array
    {
        return $this->getSkillsByClass(DefendingSkill::class);
    }

    /**
     * @param string $class
     * @return Skill[]
     */
    public function getSkillsByClass(string $class): array
    {
        $skills = [];
        foreach ($this->skill as $skill) {
            if ($skill instanceof $class) {
                $skills[] = $skill;
            }
        }

        return $skills;
    }
}