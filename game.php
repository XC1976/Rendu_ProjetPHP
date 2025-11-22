<?php
session_start();

class Mob
{
    public $name;
    public $health;
    public $originalHealth;

    public function __construct($nameInit, $healthInit)
    {
        $this->name = $nameInit;
        $this->health = $healthInit;
        $this->originalHealth = $healthInit;
    }

    public function attack($attackedMob)
    {
        $randAttack = rand(0, 20);

        $attackedMob->health -= $randAttack;

        if ($attackedMob->health < 0) {
            $attackedMob->health = 0;
            $_SESSION["messages"][] =
                $attackedMob->name .
                " est vaincu ! " .
                $this->name .
                " remporte le combat !";
        } else {
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
    $_SESSION["redDragon"] = new Mob("Dragon Rouge", 100);
}
if (!isset($_SESSION["stoneGolem"])) {
    $_SESSION["stoneGolem"] = new Mob("Golem de Pierre", 100);
}
if (!isset($_SESSION["messages"])) {
    $_SESSION["messages"] = [];
}

// Restart aka. restore the original health of the 2 mobs
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
