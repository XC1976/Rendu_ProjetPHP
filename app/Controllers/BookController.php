<?php

namespace app\Controllers;

use app\Models\BookModel;

class BookController {
    protected $bookModel;
    
    public function __construct()
    {
        $this->bookModel = new bookModel();
    }
   
   public function isBookBorrowed(int $bookId, int $userId, $bdd) {
        $borrowRequest = $this->bookModel->isBookBorrowed($bookId, $userId, $bdd);
        
        if($borrowRequest == true) {
            return true;
        } else {
            return false;
        }
   }
}