<?php
declare(strict_types=1);
namespace Hero\Domain;


use Exception;
use RuntimeException;

class CharacterAttackFactory
{
    /**
     * @throws Exception
     */
    public static function create(Character $character): CharacterAttackInterface
    {
        switch (true)
        {
            case $character instanceof SkilledCharacter: return new SkilledCharacterAttack();
            case $character instanceof Character: return new CharacterAttack();
            default: throw new RuntimeException('Invalid character type');

        }

    }
}