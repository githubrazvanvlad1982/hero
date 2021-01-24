<?php
declare(strict_types=1);

namespace Hero\Domain;


interface CharacterDefendInterface
{
    public function apply(Fight $fight): void;
}