<?php

session_start();

$ROOTPATH = '../../';

require $ROOTPATH . 'config/database.php';
require $ROOTPATH . 'app/Controllers/UserController.php';
require $ROOTPATH . 'app/Models/UserModel.php';

use app\Models\UserModel;
use app\Controllers\UserController;

$userController = new UserController();

$addBookRequest = $userController->deleteBook($_POST["bookId"], $bdd);

if($addBookRequest == false) {
    $_SESSION["errorMsg"] = "The book couldn't be deleted";
}

header('Location: ' . $ROOTPATH . 'index.php');
exit();