<?php
session_start();
// GLOBAL variables

// ROOT path
$ROOT = "";
// <title> content
$TITLE = "Page d'accueil";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!--Include with the GLOBAL content shared with all the <head> on every page-->
    <?php require "includes/head.php"; ?>

</head>
<body>

<h2>Rendu 2 2025-11-20</h2>

<form method="POST" action="actions/pari.php">
    <label for="userNumber">Choisir un nombre entre 1 et 10</label>
    <input type="number" min="1" max="10" id="userNumber" name="userNumber" value="1" required/>

    <input type="submit" name="submit" value="Parier" id="submit" onclick="playSound()" />
    <link rel="stylesheet" href="assets/css/pari.css" />
</form>

<?php if (isset($_SESSION["res"])): ?>
    <script defer>
        let soundWin = new Audio("assets/sound/win.mp3");
        let soundLose = new Audio("assets/sound/lose.mp3");

        if(<?= $_SESSION["res"]; ?> == 0) {
          soundLose.play();
        } else {
          soundWin.play();
        }
        </script>
        
    <?php if($_SESSION['res'] == 1): ?>
        <p class="green">Vous avez gagné</p>
    <?php else: ?>
        <p class="red">Vous avez perdu</p>
    <?php endif; ?>
<?php endif; ?>

<input type="hidden" id="hidden" value="5" />

</body>
</html>
