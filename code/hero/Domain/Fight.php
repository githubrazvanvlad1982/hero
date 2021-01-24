<?php
declare(strict_types=1);

namespace Hero\Domain;


use Hero\Domain\Skill\Skill;

class Fight
{
    /** @var Character */
    private $attacker;

    /** @var Character */
    private $defender;

    /** @var int */
    private $damage = 0;

    /** @var Skill[] */
    private $attackerAppliedSkills = [];

    /**
     * @var array
     */
    private $defenderAppliedSkills = [];

    /** @var int */
    private $appliedDamage;

    /** @var int */
    private $turn;

    /** @var bool  */
    private $isLuckyApplied = false;



    public function __construct(Character $attacker, Character $defender )
    {
        $this->attacker = $attacker;
        $this->defender = $defender;
    }

    /**
     * @return Character
     */
    public function getDefender(): Character
    {
        return $this->defender;
    }

    /**
     * @param Character $defender
     * @return Fight
     */
    public function setDefender(Character $defender): Fight
    {
        $this->defender = $defender;
        return $this;
    }

    /**
     * @return Character
     */
    public function getAttacker(): Character
    {
        return $this->attacker;
    }

    /**
     * @param Character $attacker
     * @return Fight
     */
    public function setAttacker(Character $attacker): Fight
    {
        $this->attacker = $attacker;
        return $this;
    }

    /**
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }

    /**
     * @param int $damage
     * @return Fight
     */
    public function setDamage(int $damage): Fight
    {
        $damage = $damage >= 0 ? $damage : 0;
        $damage = $damage <= 100 ? $damage : 100;

        $this->damage = $damage;

        return $this;
    }

    public function addAttackerAppliedSkill(Skill $skill): Fight
    {
        $this->attackerAppliedSkills[] = $skill;

        return $this;
    }

    public function addDefenderAppliedSkill(Skill $skill): Fight
    {
        $this->defenderAppliedSkills[] = $skill;

        return $this;
    }

    /**
     * @return Skill[]
     */
    public function getAttackerAppliedSkills(): array
    {
        return $this->attackerAppliedSkills;
    }

    /**
     * @return Skill[]
     */
    public function getDefenderAppliedSkills(): array
    {
        return $this->defenderAppliedSkills;
    }

    public function setAppliedDamage(int $appliedDamage): Fight
    {
        $this->appliedDamage = $appliedDamage;

        return $this;
    }

    public function getAppliedDamage(): int
    {
        return $this->appliedDamage;
    }

    public function setTurn(int $turn): Fight
    {
        $this->turn = $turn;

        return $this;
    }

    public function getTurn(): int
    {
        return $this->turn;
    }

    public function setIsLuckyApplied(bool $applied): Fight
    {
        $this->isLuckyApplied = $applied;

        return $this;
    }

    public function getIsLuckyApplied(): bool
    {
        return $this->isLuckyApplied;
    }
}