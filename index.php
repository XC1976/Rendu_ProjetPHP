<?php require "game.php"; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Jeu de combat</title>
	<link rel="stylesheet" href="style.css" />
	<script src="script.js" defer></script>
</head>
<body>

    <h1>Le combat des créatures</h1>

    <h2>Dragon Rouge</h2>
    <?= "<p>" .
        $_SESSION["redDragon"]->health .
        " / " .
        $_SESSION["redDragon"]->originalHealth .
        "</p>" ?>

    <?php if ($_SESSION["redDragon"]->health == 0): ?>
        <p>K.O</p>
    <?php else: ?>
        <p>En combat</p>
    <?php endif; ?>

    <form action="#" method="POST">
        <?php if (
            ($_SESSION["redDragon"]->health &&
                $_SESSION["stoneGolem"]->health) != 0
        ): ?>
    	    <button type="submit" name="dragonAttack" id="dragonAttack">Dragon Rouge attaque</button>
		<?php endif; ?>
	</form>

    <h2>Golem de Pierre</h2>
    <?= "<p>" .
        $_SESSION["stoneGolem"]->health .
        " / " .
        $_SESSION["stoneGolem"]->originalHealth .
        "</p>" ?>
    <?php if ($_SESSION["stoneGolem"]->health == 0): ?>
        <p>K.O</p>
    <?php else: ?>
        <p>En combat</p>
    <?php endif; ?>

    <form action="#" method="POST">
        <?php if (
            ($_SESSION["redDragon"]->health &&
                $_SESSION["stoneGolem"]->health) != 0
        ): ?>
    	    <button type="submit" name="golemAttack" id="golemAttack">Golem de Pierre attaque</button>
		<?php endif; ?>
	</form>

	<form action="#" method="POST">
        <button type="submit" name="restart" id="restart">Recommencer le combat</button>
	</form>

	<div>
	    <h3>Journal du combat</h3>
	    <ul>
	    <?php foreach ($_SESSION["messages"] as $message): ?>
			<li><?= htmlspecialchars($message) ?></li>
		<?php endforeach; ?>
		</ul>
	</div>

    <?php if ($_SESSION["redDragon"]->health == 0): ?>
        <p>Le golem de pierre est le grand vainqueur !</p>
    <?php elseif ($_SESSION["stoneGolem"]->health == 0): ?>
        <p>Le dragon rouge est le grand vainqueur !</p>
    <?php endif; ?>
    
    <footer>
        <p>Que le meilleur gagne entre ces créatures légendaires !</p>
    </footer>
</body>
</html>
