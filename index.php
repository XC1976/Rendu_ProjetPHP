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

    <main>
        <h1>Le combat des créatures</h1>

        <div class="entitiesContainer">
            <div class="entity">
                    <h2>Dragon Rouge</h2>
                    <div class="healthBar">
                        <div class="healthFill" style="width:<?= $dragonPct . '%';?>">
                        </div>
                    </div>
                    <?= "<p>" .
                        $_SESSION["redDragon"]->health .
                        " / " .
                        $_SESSION["redDragon"]->originalHealth .
                        " PV" .
                        "</p>" ?>

                    <?php if ($_SESSION["redDragon"]->health == 0): ?>
                        <p class="red">K.O</p>
                    <?php else: ?>
                        <p class="green">En combat</p>
                    <?php endif; ?>
            </div>


            <div class="entity">
                <h2>Golem de Pierre</h2>
                <div class="healthBar">
                    <div class="healthFill" style="width:<?= $golemPct . '%';?>">
                    </div>
                </div>
                <?= "<p>" .
                    $_SESSION["stoneGolem"]->health .
                    " / " .
                    $_SESSION["stoneGolem"]->originalHealth .
                    " PV" .
                    "</p>" ?>
                <?php if ($_SESSION["stoneGolem"]->health == 0): ?>
                    <p class="red">K.O</p>
                <?php else: ?>
                    <p class="green">En combat</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="btnsContainer">
            <div class="buttonDragon">
                <form action="#" method="POST">
                    <?php if (
                        ($_SESSION["redDragon"]->health &&
                            $_SESSION["stoneGolem"]->health) != 0
                    ): ?>
               	    <button type="submit" name="dragonAttack" id="dragonAttack">Dragon Rouge attaque</button>
          		<?php endif; ?>
            </div>

           <div class="buttonGolem">
               	</form>
                    <form action="#" method="POST">
                        <?php if (
                            ($_SESSION["redDragon"]->health &&
                                $_SESSION["stoneGolem"]->health) != 0
                        ): ?>
                   	    <button type="submit" name="golemAttack" id="golemAttack">Golem de Pierre attaque</button>
              		<?php endif; ?>
               	</form>
           </div>

            <div class="buttonRestart">
               	<form action="#" method="POST">
                        <button type="submit" name="restart" id="restart">Recommencer le combat</button>
               	</form>
            </div>
        </div>

    	<div class="journal">
    	    <h3>Journal du combat</h3>
    	    <ul>
    	    <?php foreach ($_SESSION["messages"] as $message): ?>
    			<li><?= htmlspecialchars($message) ?></li>
    		<?php endforeach; ?>
    		</ul>
    	</div>

        <?php if ($_SESSION["redDragon"]->health == 0): ?>
            <p class="victor"><span class="bold">Golem de pierre</span> est le grand vainqueur !</p>
        <?php elseif ($_SESSION["stoneGolem"]->health == 0): ?>
            <p class="victor"><span class="bold">Dragon rouge</span> est le grand vainqueur !</p>
        <?php endif; ?>

        <footer>
            <p>Que le meilleur gagne entre ces créatures légendaires !</p>
        </footer>
    </main>
</body>
</html>
