<?php
declare(strict_types=1);

namespace Hero\Domain;


interface CharacterAttackInterface
{
    public function apply(Fight $fight): void;
}