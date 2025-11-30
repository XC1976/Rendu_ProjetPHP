<?php

session_start();

$ROOTPATH = '../../';

require $ROOTPATH . 'config/database.php';
require $ROOTPATH . 'app/Controllers/UserController.php';
require $ROOTPATH . 'app/Models/UserModel.php';

use app\Models\UserModel;
use app\Controllers\UserController;

$userController = new UserController();

$addBookRequest = $userController->modifyBook($_POST["bookName"], $_POST["bookDescription"], $_POST["bookReleaseDate"], $_POST["bookId"], $bdd);

if($addBookRequest == false) {
    $_SESSION["errorMsg"] = "The book couldn't be modified";
}

header('Location: ' . $ROOTPATH . 'index.php');
exit();