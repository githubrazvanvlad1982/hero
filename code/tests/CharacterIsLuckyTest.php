<?php
declare(strict_types=1);

namespace Tests;


use Exception;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;

class CharacterIsLuckyTest extends TestCase
{
   use PHPMock;

    /**
     * @throws Exception
     */
    public function testWhenRandomNumberIsLessOrEqualThenLuckThenReturnTrue(): void
    {

        $randomFunc = $this->getFunctionMock('Hero\Domain', "random_int");
        $randomFunc->expects(self::any())->willReturn(20);

        $character = CharacterFactory::createCharacter([
            'luck' => 25
        ]);

        self::assertTrue($character->isLucky());
    }

    /**
     * @throws Exception
     */
    public function testWhenRandomNumberIsGreaterThenLuckReturnFalse(): void
    {
        $time = $this->getFunctionMock('Hero\Domain', "random_int");
        $time->expects(self::any())->willReturn(40);


        $character = CharacterFactory::createCharacter([
            'luck' => 30
        ]);

        self::assertFalse($character->isLucky());
    }
}