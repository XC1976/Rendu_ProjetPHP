<?php

namespace app\Controllers;

use app\Models\UserModel;

class UserController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel("fillerUsername");
    }

    public function registerUser(string $username, string $password, $bdd)
    {
        // Ensuring the user is passing through POST
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            $_SESSION["errorMsg"] =
                "You cannot access to this resource this way";
            exit();
        }

        $this->userModel->registerUser($username, $password, $bdd);
    }

    public function loginUser(string $username, string $password, $bdd)
    {
        // Ensuring the user is passing through POST
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            $_SESSION["errorMsg"] =
                "You cannot access to this resource this way";
            exit();
        }

        $this->userModel->loginUser($username, $password, $bdd);
    }

    public function logoutUser()
    {
        // Ensuring the user is passing through POST
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            $_SESSION["errorMsg"] =
                "You cannot access to this resource this way";
            exit();
        }

        // Logout user
        session_unset();
        session_destroy();
        header('Location: app/Views/register.php');
        exit();
    }
    
    public function listBooks($bdd) {
        return $this->userModel->listBooks($bdd);
    }
    
    public function listBorrowedBooks(int $userId, $bdd) {
        return $this->userModel->listBorrowedBooks($userId, $bdd);
    }
    
    public function returnBook(int $bookId, $bdd) {
        return $this->userModel->returnBook($bookId, $bdd);
    }
}
