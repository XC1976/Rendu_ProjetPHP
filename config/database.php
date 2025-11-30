<?php

require "vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('/var/www/html');
$dotenv->load();

$host = $_ENV["DB_HOST"];
$db = $_ENV["DB_NAME"];
$user = $_ENV["DB_USER"];
$passwd = $_ENV["DB_PASSWD"];

try {
    session_start();
    $bdd = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $passwd, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (Exception $e) {
    die("Une erreur a été trouvée : " . $e->getMessage());
}
