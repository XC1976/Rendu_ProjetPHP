<?php

session_start();

$ROOTPATH = '../../';

require $ROOTPATH . 'config/database.php';
require $ROOTPATH . 'app/Controllers/UserController.php';
require $ROOTPATH . 'app/Models/UserModel.php';

use app\Models\UserModel;
use app\Controllers\UserController;

$userController = new UserController();

$returnBookRequest = $userController->returnBook($_POST["bookId"], $bdd);

if($returnBookRequest == false) {
    $_SESSION['errorMsg'] = "Error in returning book";
}

header('Location: ' . $ROOTPATH . 'app/Views/borrowedBooks.php');
exit();