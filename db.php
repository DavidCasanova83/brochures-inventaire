<?php


$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');


try {
  $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

  // Créer la base de données si elle n'existe pas
  $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db`;
                USE `$db`;");

  $pdo->exec("CREATE TABLE IF NOT EXISTS brochures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    company_name VARCHAR(255),
    year_of_edition YEAR,
    quantity_available INT,
    image_path VARCHAR(255), 
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  );");
} catch (PDOException $e) {
  die("Erreur de connexion à la base de données: " . $e->getMessage());
}
