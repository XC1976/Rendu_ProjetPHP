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

<body>

    <main>
        <p><a href=<?= $ROOTPATH; ?>>Return to index</a></p>
        
        <form action=<?= $ROOTPATH . 'app/Controllers/modifyBookHandler.php'?> method="POST">
            <label for="bookName">New Book name</label>
            <input type="text" name="bookName" id="bookName" required />
            
            <label for="bookDescription">New Book description</label>
            <textarea name="bookDescription" id="bookDescription" required></textarea>
            
            <label for="bookReleaseDate">New Date of release</label>
            <input type="date" name="bookReleaseDate" id="bookReleaseDate" required />
            
            <input type="hidden" name="bookId" value=<?= $_POST["bookId"]; ?> />
            
            <input type="submit" name="submit" value="Add book">
        </form>
    </main>
    
</body>
</html>