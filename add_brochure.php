<?php
include 'db.php';

// Vérification du type de requête : s'assurer que le formulaire a été soumis via une requête POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Assainissement des entrées utilisateur pour prévenir les failles XSS (Cross-Site Scripting).
  // L'utilisation de htmlspecialchars() est recommandée pour convertir des caractères spéciaux en entités HTML,
  // ce qui est utile pour empêcher l'exécution de scripts malveillants si les données sont affichées dans un navigateur.
  // Si une valeur n'est pas définie ($_POST['value']), une chaîne vide ('') ou une valeur par défaut (comme 0 pour les entiers) est assignée.

  $title = $_POST['title'] ? htmlspecialchars($_POST['title']) : ''; // Convertit les caractères spéciaux du titre en entités HTML.
  $description = $_POST['description'] ? htmlspecialchars($_POST['description']) : ''; // Convertit les caractères spéciaux de la description en entités HTML.
  $company_name = $_POST['company_name'] ? htmlspecialchars($_POST['company_name']) : ''; // Convertit les caractères spéciaux du nom de l'entreprise en entités HTML.

  // Pour les données numériques, filter_var() avec FILTER_VALIDATE_INT est utilisé pour s'assurer que la valeur est un entier valide.
  // Cela aide à prévenir les injections SQL et les erreurs de type de données.
  $year_of_edition = $_POST['year_of_edition'] ? filter_var($_POST['year_of_edition'], FILTER_VALIDATE_INT) : 0; // Valide et filtre l'année d'édition.
  $quantity_available = $_POST['quantity_available'] ? filter_var($_POST['quantity_available'], FILTER_VALIDATE_INT) : 0; // Valide et filtre la quantité disponible.

  $image_path = ""; // Initialisation de la variable pour le chemin de l'image.


  // Traitement de l'upload de l'image
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // Définition du répertoire cible pour les fichiers téléchargés
    $target_dir = "uploads/";
    // Création d'un nom de fichier unique pour éviter les écrasements de fichiers
    $target_file = $target_dir . uniqid() . basename($_FILES["image"]["name"]);
    // Extraction et conversion en minuscules de l'extension du fichier
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérification du type de fichier - doit être une image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
      error_log('Le fichier téléchargé n\'est pas une image.');
      die("Le fichier téléchargé n'est pas une image.");
    }

    // Vérification de la taille de l'image
    if ($_FILES["image"]["size"] > 35000000) { // Limite fixée à 35MB
      error_log('Le fichier est trop volumineux.');
      die("Le fichier est trop volumineux.");
    }

    // Vérification du format de l'image - autorise uniquement certains formats
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      error_log('Format de fichier non autorisé.');
      die("Format de fichier non autorisé.");
    }

    // Déplacement du fichier téléchargé vers le répertoire cible
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      error_log('Erreur lors du téléchargement de l\'image.');
      die("Erreur lors du téléchargement de l'image.");
    }

    // Encodage des caractères spéciaux du chemin de l'image pour la sécurité
    $image_path = htmlspecialchars($target_file);
  }

  // Utilisation de requêtes préparées pour insérer des données - prévient les injections SQL
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

  // Redirection de l'utilisateur vers la page d'accueil après l'insertion des données
  header("Location: index.php");
}
