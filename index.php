<?php
include 'db.php';

// Récupérer les brochures
$stmt = $pdo->query("SELECT * FROM brochures");
$brochures = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
  <title>Liste de brochures</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-5">
  <div class="flex items-center justify-around mb-6">
    <h1 class="text-3xl font-bold mb-5">Liste de brochures</h1>
    <a href="add_brochure_form.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter une Brochure</a>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($brochures as $brochure) : ?>
      <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex items-center justify-start space-x-2">
          <h3 class="text-xl font-bold"><?php echo htmlspecialchars($brochure['title']); ?></h3>
          <?php if (!empty($brochure['image_path'])) : ?>
            <a href="<?php echo htmlspecialchars($brochure['image_path']); ?>" target="_blank" class="text-blue-500 hover:text-blue-700">- Voir l'image</a>
          <?php endif; ?>
        </div>
        <p class="text-gray-700 mb-2"><?php echo htmlspecialchars($brochure['description']); ?></p>
        <p class="text-gray-600"><?php echo htmlspecialchars($brochure['company_name']) . " - " .
                                    htmlspecialchars($brochure['year_of_edition']) . " - " .
                                    htmlspecialchars($brochure['quantity_available']) . " disponibles"; ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</body>

</html>