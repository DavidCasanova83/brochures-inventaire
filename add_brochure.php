<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $company_name = $_POST['company_name'];
  $year_of_edition = $_POST['year_of_edition'];
  $quantity_available = $_POST['quantity_available'];
  $image_path = "";

  // Traitement de l'upload de l'image
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $target_dir = "uploads/"; // Assurez-vous que ce dossier existe et est accessible en écriture
    $target_file = $target_dir . uniqid() . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérifier si le fichier est une image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
      die("Le fichier n'est pas une image.");
    }

    // Vérifier la taille de l'image
    if ($_FILES["image"]["size"] > 35000000) { // 35MB
      die("Désolé, votre fichier est trop volumineux.");
    }

    // Vérifier le format de l'image
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      die("Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.");
    }

    // Télécharger l'image
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      die("Désolé, une erreur s'est produite lors du téléchargement de votre fichier.");
    }

    $image_path = $target_file;
  }

  // Insertion des données dans la base de données
  $stmt = $pdo->prepare("INSERT INTO brochures (title, description, company_name, year_of_edition, quantity_available, image_path) 
                           VALUES (:title, :description, :company_name, :year_of_edition, :quantity_available, :image_path)");
  $stmt->execute([
    'title' => $title,
    'description' => $description,
    'company_name' => $company_name,
    'year_of_edition' => $year_of_edition,
    'quantity_available' => $quantity_available,
    'image_path' => $image_path
  ]);

  header("Location: index.php");
}
