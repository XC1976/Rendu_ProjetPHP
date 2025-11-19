<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Exercice 1</title>
	<script src="script.js" defer></script>
	<link rel="stylesheet" href="style.css" />
</head>
<body>
    <?php $produits = [
        [
            "nom" => "Pomme",
            "prix" => 200,
            "origine" => "France",
            "stock" => 10,
        ],
        [
            "nom" => "Banane",
            "prix" => 150,
            "origine" => "Côte Ivoire",
            "stock" => 5,
        ],
        [
            "nom" => "Mangue",
            "prix" => 300,
            "origine" => "Sénégal",
            "stock" => 2,
        ],
        [
            "nom" => "Test stock 0",
            "prix" => 300,
            "origine" => "Sénégal",
            "stock" => 0,
        ],
    ]; ?>

<table>
    <tr>
        <th>Nom</th>
        <th>Prix</th>
        <th>Origine</th>
        <th>Stock</th>
        <th>Achat</th>
        <th>Achat (en JS)</th>
    </tr>
    <?php foreach ($produits as $value): ?>

        <tr>
            <td><?= $value["nom"] ?></td>
            <td><?= $value["prix"] ?></td>
            <td><?= $value["origine"] ?></td>

            <!--Si stock == 0, alors affiche "rupture de stock" en rouge
            Si stock < 3, afficher "stock faible" en orange-->

            <?php if ($value["stock"] === 0): ?>
                <td class="red"><?= "Rupture de stock" ?></td>
            <?php elseif ($value["stock"] < 3): ?>
                <td class="orange"><?= "Stock faible" ?></td>
            <?php else: ?>
                <td><?= $value["stock"] ?></td>
            <?php endif; ?>

            <!--Bouton individuels pour envoyer les informations en PHP -->
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

            <td>
                <button onclick="buttonClicked('<?= $value['nom']; ?>', '<?= $value['prix']; ?>', '<?= $value['origine']; ?>', '<?= $value['stock']; ?>')"><?= 'Acheter : ' . $value['nom'];?></button>
            </td>


        </tr>
    <?php endforeach; ?>
</table>
</body>


</html>
