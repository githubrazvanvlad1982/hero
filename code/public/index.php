<?php

use Hero\Domain\Battle;
use Hero\Domain\Character;
use Hero\Domain\Fight;
use Hero\Domain\Skill\MagicShieldSkill;
use Hero\Domain\Skill\RapidStrikeSkill;
use Hero\Domain\SkilledCharacter;
use function DeepCopy\deep_copy;

require_once(__DIR__ . '/../vendor/autoload.php');

$orderus = new SkilledCharacter(
    'Orderus',
    random_int(70, 100),
    random_int(70, 80),
    random_int(45, 55),
    random_int(40,50),
    random_int(10, 30),
    [new MagicShieldSkill(), new RapidStrikeSkill()]
);

$beast = new Character(
    'beast',
    random_int(60, 90),
    random_int(60, 90),
    random_int(40, 60),
    random_int(40,60),
    random_int(25, 40)
);

$battle = new Battle();
$fights = $battle->battle(deep_copy($orderus), deep_copy($beast), 20);

echo "Orderus: <br/>"
 . "health: " . $orderus->getHealth() . "<br/>"
    . "strength: " . $orderus->getStrength() . "<br/>"
    . "defence: " . $orderus->getDefence() . "<br/>"
    . "speed: " . $orderus->getSpeed() . "<br/>"
    . "luck: " . $orderus->getLuck() . "<br/>";

echo "<br/><br/>";

echo "Beast: <br/>"
    . "health: " . $beast->getHealth() . "<br/>"
    . "strength: " . $beast->getStrength() . "<br/>"
    . "defence: " . $beast->getDefence() . "<br/>"
    . "speed: " . $beast->getSpeed() . "<br/>"
    . "luck: " . $beast->getLuck() . "<br/>";

echo "<br/><br/>";

/** @var Fight $fight */
foreach ($fights as $fight) {
    echo "Fight #" . $fight->getTurn() . '<br/>';
    echo "Attacker: " . $fight->getAttacker()->getName() . " ->  "
        . "used skill: " . formatSkills($fight->getAttackerAppliedSkills()) . '; '
        . "applied damage: " . $fight->getAppliedDamage() . "<br/>";

    echo "Defender: " . $fight->getDefender()->getName() . ' -> '
        . "IsLuckyApplied: " . ($fight->getIsLuckyApplied()  === true ? 'true' : 'false') . '; '
        . "used skill: " . formatSkills($fight->getDefenderAppliedSkills()) . '; '
        . "receivedDamage: " .  $fight->getDamage() . '; '
        . "health : " . $fight->getDefender()->getHealth() ;

    echo "<br/><br/>";


}

function formatSkills(array $skills): string
{
    $skillsNames = [];
    foreach ($skills as $skill) {
        $skillsNames[] = get_class($skill);
    }

    return implode(',', $skillsNames);
}