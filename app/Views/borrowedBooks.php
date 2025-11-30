<?php
session_start();

$ROOTPATH = "../../";

require $ROOTPATH . "config/database.php";
require $ROOTPATH . "app/Controllers/UserController.php";
require $ROOTPATH . "app/Models/UserModel.php";

use app\Models\UserModel;
use app\Controllers\UserController;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gestion de bibliothèque</title>
	<link rel="stylesheet" href=<?= $ROOTPATH . "assets/css/style.css" ?> />
	<script src=<?= $ROOTPATH . "assets/js/script.js" ?> defer></script>

    <?php include $ROOTPATH . "includes/favicon.php"; ?>
</head>

<?php
$bookController = new UserController();

$listBorrowedBooks = $bookController->listBorrowedBooks(
    $_SESSION["user"]["id"],
    $bdd
);
?>

<body>

    <main>
        <p><a href=<?= $ROOTPATH . "index.php" ?>>Come back to index.php</a></p>

        <section>
            <?php if($listBorrowedBooks != false): ?>
                <?php foreach ($listBorrowedBooks as $book): ?>
                    <p><?= $book["nameBook"] ?></p>
                    <p><?= $book["releaseDate"] ?></p>
                    <p><?= $book["description"] ?></p>
                    <form action=<?= $ROOTPATH . 'app/Controllers/returnHandler.php'; ?> method="POST">
                        <button type="submit" name="returnBook">Return book</button>
                        <input type="hidden" name="bookId" value="<?= htmlspecialchars(
                            $book["id"],
                        ) ?>" />
                    </form>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>

</body>
</html>
