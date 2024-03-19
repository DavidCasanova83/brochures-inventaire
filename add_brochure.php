<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $company_name = $_POST['company_name'];
  $year_of_edition = $_POST['year_of_edition'];
  $quantity_available = $_POST['quantity_available'];

  $stmt = $pdo->prepare("INSERT INTO brochures (title, description, company_name, year_of_edition, quantity_available) 
                         VALUES (:title, :description, :company_name, :year_of_edition, :quantity_available)");
  $stmt->execute([
    'title' => $title,
    'description' => $description,
    'company_name' => $company_name,
    'year_of_edition' => $year_of_edition,
    'quantity_available' => $quantity_available
  ]);

  header("Location: index.php");
}
