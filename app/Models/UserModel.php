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
}