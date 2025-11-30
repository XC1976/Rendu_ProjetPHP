<!DOCTYPE html>
<?php
session_start();

// Global variables
$ROOTPATH = '../../';

// Files requires / includes...
require $ROOTPATH . 'config/database.php';

// Classes handling
require $ROOTPATH . 'app/Controllers/UserController.php';
require $ROOTPATH . 'app/Models/UserModel.php';

use app\Controllers\UserController;
use app\Models\UserModel;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gestion de bibliothèque</title>
	<link rel="stylesheet" href=<?= $ROOTPATH . 'assets/css/style.css'; ?> />
	<script src=<?= $ROOTPATH . 'assets/js/script.js'; ?> defer></script>

	<?php include $ROOTPATH . 'includes/favicon.php'; ?>
</head>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userController = new UserController();

    $userController->loginUser($_POST["username"], $_POST["password"], $bdd);
} ?>

<body>

    <main>
        
        <?php if (isset($_SESSION["errorMsg"])): ?>
        <p><?= $_SESSION["errorMsg"] ?></p>
        <?php unset($_SESSION["errorMsg"]); ?>
        <?php endif; ?>
        
        <form action="#" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" />
            
            <label for="password">Password</label>
            <input type="text" name="password" id="password" />
            
            <input type="submit" name="submit" value="Login" />
        </form>
        
        <p><a href="register.php">Register page</a></p>
    </main>
    
</body>
</html>