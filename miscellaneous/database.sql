DROP DATABASE ipssi_db;
CREATE DATABASE ipssi_db;
USE ipssi_db;

-- Create Tables
CREATE TABLE USER (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20),
    password VARCHAR(60),
    admin BOOLEAN
);

CREATE TABLE BOOK (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nameBook VARCHAR(255) NOT NULL,
    releaseDate DATE NOT NULL,
    description TEXT NOT NULL,
    idUser INTEGER,
    CONSTRAINT FK_idUser FOREIGN KEY (idUser) REFERENCES USER(id)
);

-- Inserting some books
INSERT INTO BOOK(nameBook, releaseDate, description) VALUES('book1', '2025-10-01', 'Description of book1');
INSERT INTO BOOK(nameBook, releaseDate, description) VALUES('book2', '2025-10-02', 'Description of book2');
INSERT INTO BOOK(nameBook, releaseDate, description) VALUES('book3', '2025-10-03', 'Description of book3');
INSERT INTO BOOK(nameBook, releaseDate, description) VALUES('book4', '2025-10-04', 'Description of book4');