<?php
declare(strict_types=1);
namespace Hero\Domain;


use Exception;
use RuntimeException;

class CharacterDefendFactory
{
    /**
     * @throws Exception
     */

    public static function create(Character $character): CharacterDefendInterface
    {
        switch (true    )
        {
            case $character instanceof SkilledCharacter: return new SkilledCharacterDefend();
            case $character instanceof Character: return new CharacterDefend();
            default: throw new RuntimeException('Invalid character type');

        }

    }
}