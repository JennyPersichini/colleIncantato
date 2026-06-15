-- Creo il db

CREATE DATABASE IF NOT EXISTS agriturismo_app
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE agriturismo_app;


-- Tabella Utenti

CREATE TABLE IF NOT EXISTS users (

    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'admin') NOT NULL DEFAULT 'client',   
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB;

--Prodotti

CREATE TABLE IF NOT EXISTS prodotti(

    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(100) NOT NULL,
    subCategory VARCHAR(100) NOT NULL,
    quantity DECIMAL(10,2) NOT NULL,
    disposability BOOLEAN NOT NULL DEFAULT TRUE,
    price DECIMAL(10,2) NOT NULL,
    image_path VARCHAR(255) DEFAULT NULL

) ENGINE=InnoDB;

--Prenotazioni

CREATE TABLE prenotazioni (

    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    data_evento DATE NOT NULL,
    tipo ENUM('esperienza', 'pranzo', 'cena') NOT NULL,
    numero_persone INT NOT NULL,
    messaggio TEXT,
    stato ENUM('in_attesa', 'confermata', 'rifiutata') DEFAULT 'in_attesa',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    
) ENGINE=InnoDB;
