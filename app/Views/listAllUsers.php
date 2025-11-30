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
        
    </main>

</body>
</html>