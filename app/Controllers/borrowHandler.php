<?php

session_start();

$ROOTPATH = '../../';

require $ROOTPATH . 'config/database.php';
require $ROOTPATH . 'app/Controllers/BookController.php';
require $ROOTPATH . 'app/Models/BookModel.php';

use app\Models\BookModel;
use app\Controllers\BookController;

$bookController = new BookController();
$BorrowRequest = $bookController->isBookBorrowed($_POST["bookId"], $_SESSION['user']['id'], $bdd);

if($BorrowRequest == false) {
    $_SESSION["errorMsg"] = "Unknown error";
}

header('Location: ' . $ROOTPATH);