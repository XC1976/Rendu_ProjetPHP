<?php

namespace app\Models;

class UserModel {
    public $username;
    
    public function __construct(string $usernameInit)
    {
        $this->username = $usernameInit;
    }
    
    public function registerUser(string $username, string $password, $bdd) {
        // Verify the user doesn't already exist
        $userExists = $bdd->prepare('SELECT id FROM USER WHERE username = ?');
        $userExists->execute([$username]);

        $user = $userExists->fetch();
        if($user) {
            $_SESSION['errorMsg'] = "Username already taken";
            return;
        }
        
        // Hashing password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database
        $insertUser = $bdd->prepare('INSERT INTO USER(username, password) VALUES(?, ?)');
        $insertUser->execute([$username, $hashedPassword]);
        
        header('Location: ../../app/Views/login.php');
    }
    
    public function loginUser(string $username, string $password, $bdd) {
        // Verify the username indeed exists
        $userExists = $bdd->prepare('SELECT id, username, password FROM USER WHERE username = ?');
        $userExists->execute([$username]);
        $user = $userExists->fetch();
        
        if(!$user) {
            $_SESSION['errorMsg'] = "Cet utilisateur n'existe pas";
            exit();
        }
        
        // Verify if the password math

        $hashedPassword = $user['password'];
        if(!password_verify($password, $hashedPassword)) {
            $_SESSION['errorMsg'] = "Password do not match";
            exit();
        }
        
        // Stores the relevant information into $_SESSION
        $_SESSION['user'] = [
            'username' => $user["username"],
            'id' => $user['id']
        ];
        
        // Header location to index.php
        header('Location: ../../index.php');
    }
    
    public function listBooks($bdd) {
        $fetchBooks = $bdd->prepare('SELECT nameBook, releaseDate, description, idUser, id FROM BOOK');
        $fetchBooks->execute();

        $listBooks = $fetchBooks->fetchAll();

        return $listBooks;
    }
    
    public function listBorrowedBooks(int $userId, $bdd) {
        // Select every books borrowed from user
        $userBorrowedBooksReq = $bdd->prepare('SELECT id, nameBook, releaseDate, description FROM BOOK WHERE idUser = ?');
        $userBorrowedBooksReq->execute([$userId]);
        $userBorrowedBooks = $userBorrowedBooksReq->fetchAll();
        
        if($userBorrowedBooks) {
            return $userBorrowedBooks;
        } else {
            return false;
        }
    }
    
    public function returnBook(int $bookId, $bdd) {
        // Return book
        $returnBookReq = $bdd->prepare('UPDATE BOOK SET idUser = NULL WHERE id = ?');
        $returnBookReq->execute([$bookId]);

        $returnBook = $returnBookReq->rowCount();
        
        if($returnBook > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function addBook(string $bookName, string $bookDescription, string $bookReleaseDate, $bdd) {
        // Add book

        $addBookReq = $bdd->prepare('INSERT INTO BOOK(nameBook, releaseDate, description) VALUES(?, ?, ?)');
        $success = $addBookReq->execute([$bookName, $bookReleaseDate, $bookDescription]);
       
        if($success) {
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteBook(int $bookId, $bdd) {
        $verifyBookExistsReq = $bdd->prepare('SELECT id FROM BOOK WHERE id = ?');
        $verifyBookExistsReq->execute([$bookId]);
        $verifyBookExists = $verifyBookExistsReq->fetch();
        
        if(!$verifyBookExists) {
            $_SESSION["errorMsg"] = "Le livre n'existe pas";
            exit();
        }
        
        // Delete book
        $deleteBookReq = $bdd->prepare('DELETE FROM BOOK WHERE id = ?');
        $success = $deleteBookReq->execute([$bookId]);
        
        if($success) {
            return true;
        } else {
            return false;
        }
    }
    
    public function modifyBook(string $bookName, string $bookDescription, string $bookReleaseDate, int $bookId, $bdd) {
        $verifyBookExistsReq = $bdd->prepare('SELECT id FROM BOOK WHERE id = ?');
        $verifyBookExistsReq->execute([$bookId]);
        $verifyBookExists = $verifyBookExistsReq->fetch();
        
        if(!$verifyBookExists) {
            $_SESSION["errorMsg"] = "Le livre n'existe pas";
            exit();
        }

        $modifyBookReq = $bdd->prepare('UPDATE BOOK SET nameBook = ?, releaseDate = ?, description = ? WHERE id = ?');
        $success = $modifyBookReq->execute([$bookName, $bookReleaseDate, $bookDescription, $bookId]);
        
        if($success) {
            return true;
        } else {
            return false;
        }
    }
}