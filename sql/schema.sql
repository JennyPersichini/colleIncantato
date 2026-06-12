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

