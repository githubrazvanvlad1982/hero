<?php


namespace Tests;


use Hero\Domain\Character;

class CharacterFactory
{
    public static function createCharacter(?array $data = []): Character
    {
        return  new Character(
            $data['health'] ?? 70,
            $data['strength'] ?? 75,
            $data['defence'] ?? 45,
            $data['speed'] ?? 40,
            $data['luck'] ?? 0
        );
    }
}