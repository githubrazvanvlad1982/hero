<?php
declare(strict_types=1);

namespace Hero\Domain;

use Exception;
use Hero\Domain\Skill\AttackingSkill;
use Hero\Domain\Skill\DefendingSkill;
use Hero\Domain\Skill\Skill;

class Character
{
    /** @var int */
    private $health;

    /** @var int */
    private $strength;

    /** @var int */
    private $defence;

    /** @var int */
    private $speed;

    /** @var int */
    private $luck;

    /** @var array $defendingSkill */
    private $skill = [];

    public function __construct(
        int $health,
        int $strength,
        int $defence,
        int $speed,
        int $luck
    )
    {
        $this->health = $health;
        $this->strength = $strength;
        $this->defence = $defence;
        $this->speed = $speed;
        $this->luck = $luck;

    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    public function setHealth(int $health): void
    {
        $this->health = $health;
    }

    /**
     * @throws Exception
     */
    public function isLucky(): bool
    {
       return random_int(1, 100) <= $this->luck;
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