<?php
session_start();

// Global variables
$ROOTPATH = "./";

// Files requires / includes...
require $ROOTPATH . "config/database.php";
require $ROOTPATH . "includes/globalFunctions.php";

// Classes handling
require $ROOTPATH . "app/Controllers/UserController.php";
require $ROOTPATH . "app/Models/UserModel.php";

use app\Controllers\UserController;
use app\Models\UserModel;
?>

<?php if (!verifyIfUserConnected()) {
    header("Location: app/Views/register.php");
} ?>

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
$userController = new UserController();
$listBooks = $userController->listBooks($bdd);
?>
<?php if (isset($_POST["logout"])) {
    $userController->logoutUser();
} ?>
<body>

    <header>
        <?php if (isset($_SESSION["user"])): ?>
            <p><a href=<?= $ROOTPATH .
                "app/Views/borrowedBooks.php" ?>>Your borrowed books</a></p>
            <p><a href=<?= $ROOTPATH .
                "app/Views/addBook.php" ?>>Add a book</a></p>

            <form method="POST" action="#">
            <button type="submit" name="logout">Logout</button>
            </form>
        <?php endif; ?>
    </header>

    <main>

        <?php if (isset($_SESSION["errorMsg"])): ?>
        <p><?= $_SESSION["errorMsg"] ?></p>
        <?php unset($_SESSION["errorMsg"]); ?>
        <?php endif; ?>

        <section class="booksContainer">

            <?php foreach ($listBooks as $book): ?>
            <div class="individualBook">
               <p>Title : <?= htmlspecialchars($book["nameBook"]) ?></p>
               <p>Release date : <?= htmlspecialchars($book["releaseDate"]) ?></p>
               <p>Description : <?= htmlspecialchars($book["description"]) ?></p>
               <?php if ($book["idUser"] == null): ?>
                    <form action="app/Controllers/borrowHandler.php" method="POST">
                        <button type="submit" name="borrowBook">Borrow</button>
                        <input type="hidden" name="bookId" value="<?= htmlspecialchars(
                            $book["id"],
                        ) ?>" />
                    </form>
                <?php else: ?>
                    <p>Already borrowed</p>
               <?php endif; ?>
               <form action="app/Controllers/deleteHandler.php" method="POST">
                   <button type="submit" name="borrowBook">Delete book</button>
                   <input type="hidden" name="bookId" value="<?= htmlspecialchars(
                       $book["id"],
                   ) ?>" />
               </form>
               <form action="app/Views/modifyBook.php" method="POST">
                   <button type="submit" name="borrowBook">Modify Book</button>
                   <input type="hidden" name="bookId" value="<?= htmlspecialchars(
                       $book["id"],
                   ) ?>" />
               </form>
            </div>
            <?php endforeach; ?>
        </section>
    </main>

</body>
</html>
