<?php
session_start();

function jouer_pari(int $userNumChoice) {
    $randNumber = rand(1, 10);

    $_SESSION['number'] = $randNumber;

    return ($randNumber == $userNumChoice) ? true : false;
}

$res = jouer_pari($_POST['userNumber']);

if($res == true) {
    $_SESSION['res'] = 1;
} else {
    $_SESSION['res'] = 0;
}

setcookie("key", "value");

header('Location: ../index.php');
exit();