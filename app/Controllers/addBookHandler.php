<?php

session_start();

$ROOTPATH = '../../';

require $ROOTPATH . 'config/database.php';
require $ROOTPATH . 'app/Controllers/UserController.php';
require $ROOTPATH . 'app/Models/UserModel.php';

use app\Models\UserModel;
use app\Controllers\UserController;

$userController = new UserController();

$addBookRequest = $userController->addBook($_POST["bookName"], $_POST["bookDescription"], $_POST["bookReleaseDate"], $bdd);

if($addBookRequest == false) {
    $_SESSION["errorMsg"] = "The book couldn't be added";
}

header('Location: ' . $ROOTPATH . 'app/Views/addBook.php');
exit();