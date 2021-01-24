<?php


namespace Tests;


use Hero\Domain\Character;
use Hero\Domain\SkilledCharacter;

class SkilledCharacterFactory
{
    public static function createCharacter(?array $data = []): Character
    {
        if (empty($data['skills'])) {
            $data['skills'] = [];
        }

        return new SkilledCharacter(
            $data['name'] ?? 'name',
            $data['health'] ?? 70,
            $data['strength'] ?? 75,
            $data['defence'] ?? 45,
            $data['speed'] ?? 40,
            $data['luck'] ?? 0,
                $data['skills']
        );
    }
}