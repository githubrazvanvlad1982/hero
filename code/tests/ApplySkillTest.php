<?php
declare(strict_types=1);

namespace Tests;

use Exception;
use Hero\Domain\Skill\Skill;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;

class ApplySkillTest extends TestCase
{
    use PHPMock;
    /**
     * @throws Exception
     */
    public function testWhenRandomNumberIsLessOrEqualToChanceThenApplySkill(): void
    {
        $randomNumber = 20;
        $chance = 30;
        $randomFunc = $this->getFunctionMock('Hero\Domain\Skill', "random_int");
        $randomFunc->expects(self::any())->willReturn($randomNumber);

        $skill = (new class($chance) extends Skill {
            public function apply(int &$damage): void {
                $damage *=3;
            }
        });

        self::assertTrue($skill->canApply());
    }

    /**
     * @throws Exception
     */
    public function testWhenRandomNumberIsGreaterThenChanceThenDontApplySkill(): void
    {
        $randomNumber = 50;
        $chance = 30;
        $randomFunc = $this->getFunctionMock('Hero\Domain\Skill', "random_int");
        $randomFunc->expects(self::any())->willReturn($randomNumber);

        $skill = (new class($chance) extends Skill {
            public function apply(int &$damage): void {
                $damage *=3;
            }
        });

        self::assertFalse($skill->canApply());
    }
}