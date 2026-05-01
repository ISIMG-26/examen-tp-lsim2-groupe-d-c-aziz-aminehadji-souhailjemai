
CREATE DATABASE IF NOT EXISTS bookstore;
USE bookstore;


CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    auteur VARCHAR(100) NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    description TEXT,
    categorie VARCHAR(50),
    stock INT DEFAULT 0,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (nom, email, password) 
VALUES ('admin', 'admin@admin.com', '$2y$10$3zIG7.Jpze53nejAjwbQCeGQheFhN8pTFFaEPUOighmD8W815tUbW');

INSERT INTO books (titre, auteur, prix, description, categorie, stock) VALUES
('Le Seigneur des Anneaux', 'J.R.R. Tolkien', 25.99, 'Une épopée fantastique', 'Fantasy', 5),
('Harry Potter', 'J.K. Rowling', 19.99, 'L\'histoire d\'un jeune magicien', 'Fantasy', 8),
('1984', 'George Orwell', 15.50, 'Un roman dystopique', 'Science-fiction', 12),
('Fondation', 'Isaac Asimov', 22.00, 'L\'histoire d\'une galaxie', 'Science-fiction', 6),
('Dune', 'Frank Herbert', 28.00, 'Une aventure spatiale épique', 'Science-fiction', 4);
