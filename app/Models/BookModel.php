<?php

namespace app\Models;

class BookModel {
   
   public function isBookBorrowed(int $bookId, int $userId, $bdd) {
        $isBookBorrowed = $bdd->prepare('SELECT id FROM BOOK WHERE id = ? && idUser IS NULL');
        $isBookBorrowed->execute([$bookId]);
        $book = $isBookBorrowed->fetch();
        
        if(!$book) {
            $_SESSION['errorMsg'] = "Book does not exist or is already borrowed";
            header('Location: ../../index.php');
            exit();
        }

        // Update the book to now be borrowed by the current user
        $borrowBook = $bdd->prepare('UPDATE BOOK SET idUser = ? WHERE id = ?');
        $borrowBook->execute([$userId, $bookId]);

        return true;
   } 
}