<?php
    // GLOBAL variables
    
    // ROOT path
    $ROOT = "";
    // <title> content
    $TITLE = "Page d'accueil";
?>

<?php require "includes/productsList.php"; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!--Include with the GLOBAL content shared with all the <head> on every page-->
    <?php require "includes/head.php"; ?>

	<link rel="stylesheet" href="<?= $ROOT . "assets/css/table.css" ?>" />
	<script src="<?= $ROOT . "assets/js/tablePurchase.js" ?>" defer></script>
</head>
<body>

<!-- Table for the first iteration (2025-11-19) of this project -->
<table>
    <tr>
        <th>Nom</th>
        <th>Prix</th>
        <th>Origine</th>
        <th>Stock</th>
        <th>Achat (PHP $_POST)</th>
        <th>Achat (JS $_GET)</th>
    </tr>
    
    <!-- foreach statement to generate a custom button or input-->
    <?php foreach ($produits as $value): ?>

        <tr>
            <td><?= $value["nom"] ?></td>
            <td><?= $value["prix"] ?></td>
            <td><?= $value["origine"] ?></td>

            <!--if stock == 0, "rupture de stock" appears as red
            if stock < 3, "stock faible" appears as orange-->

            <?php if ($value["stock"] === 0): ?>
                <td class="red"><?= "Rupture de stock" ?></td>
            <?php elseif ($value["stock"] < 3): ?>
                <td class="orange"><?= "Stock faible (" . $value['stock'] . ')' ?></td>
            <?php else: ?>
                <td><?= $value["stock"] ?></td>
            <?php endif; ?>

            <!--Individual button to send the required information in PHP using input type="hidden" -->
            <td>
                <form action="pageAchat.php" method="POST">

                    <input type="hidden" name="nom" value="<?= htmlspecialchars(
                        $value["nom"],
                    ) ?>">
                    <input type="hidden" name="prix" value="<?= htmlspecialchars(
                        $value["prix"],
                    ) ?>">
                    <input type="hidden" name="origine" value="<?= htmlspecialchars(
                        $value["origine"],
                    ) ?>">
                    <input type="hidden" name="stock" value="<?= htmlspecialchars(
                        $value["stock"],
                    ) ?>">

                    <input type="submit" name="submit" value="<?= "Acheter : " .
                        htmlspecialchars($value["nom"]) ?>"/>
                </form>
            </td>
            
            <!-- Individual button to send the required information with JS using $_GET variables -->
            <td>
                <button onclick="buttonClicked('<?= $value[
                    "nom"
                ] ?>', '<?= $value["prix"] ?>',
                '<?= $value["origine"] ?>',
                '<?= $value["stock"] ?>')">
                <?= "Acheter : " . $value["nom"] ?>
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>


</html>
