<?php
session_start();

// The class defining both objects
class Mob
{
    public $name;
    public $health;
    public $originalHealth;

    // Simple constructor to choose the name and the health stat
    public function __construct($nameInit, $healthInit)
    {
        $this->name = $nameInit;
        $this->health = $healthInit;
        // Storing the original health for other algorithmic reason
        $this->originalHealth = $healthInit;
    }

    // Method to attack another mob
    public function attack($attackedMob)
    {
        $randAttack = rand(0, 20);

        // Substract the other mob health by a random number between 0 and 20
        $attackedMob->health -= $randAttack;

        if ($attackedMob->health < 0) {
            // Ensures the health cannot go below 0
            $attackedMob->health = 0;
            
            // Append a unique message of who was defeated in $_SESSION['messages']
            $_SESSION["messages"][] =
                $attackedMob->name .
                " est vaincu ! " .
                $this->name .
                " remporte le combat !";
        } else {
            // If no one is defeated, append a message of the action in $_SESSION['messages']
            $_SESSION["messages"][] =
                $this->name .
                " attaque " .
                $attackedMob->name .
                " et lui inflige " .
                $randAttack .
                " points de dégats.";
        }
    }
}

// Initialize mobs if not already done
if (!isset($_SESSION["redDragon"])) {
    $_SESSION["redDragon"] = new Mob("Dragon Rouge", 150);
}
if (!isset($_SESSION["stoneGolem"])) {
    $_SESSION["stoneGolem"] = new Mob("Golem de Pierre", 150);
}
// $_SESSION['messages'] stores the messages shown in the "Journal du combat" section
if (!isset($_SESSION["messages"])) {
    $_SESSION["messages"] = [];
}

// Restart aka. restore the original health of the 2 mobs and empty the log $_SESSION['messages']
if (isset($_POST["restart"])) {
    $_SESSION["redDragon"]->health = $_SESSION["redDragon"]->originalHealth;
    $_SESSION["stoneGolem"]->health = $_SESSION["stoneGolem"]->originalHealth;
    $_SESSION["messages"] = [];
}

// Attack the golem button action
if (isset($_POST["dragonAttack"])) {
    $_SESSION["redDragon"]->attack($_SESSION["stoneGolem"]);
}

// Attack the dragon button action
if (isset($_POST["golemAttack"])) {
    $_SESSION["stoneGolem"]->attack($_SESSION["redDragon"]);
}

// Calculate the percentage of the remaining health compared to the total health for the dynamic health bar using width CSS

$dragonPct = ($_SESSION["redDragon"]->health / $_SESSION["redDragon"]->originalHealth) * 100;
// Ensures no division by 0
$dragonPct = $dragonPct < 0 ? 0 : $dragonPct;

$golemPct = ($_SESSION["stoneGolem"]->health / $_SESSION["stoneGolem"]->originalHealth) * 100;
// Ensures no division by 0
$golemPct = $golemPct < 0 ? 0 : $golemPct;