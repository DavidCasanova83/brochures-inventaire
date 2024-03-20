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
  <h1 class="text-3xl font-bold mb-5">Liste de brochures</h1>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($brochures as $brochure) : ?>
      <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="text-xl font-bold mb-2"><?php echo htmlspecialchars($brochure['title']); ?></h3>
        <p class="text-gray-700 mb-2"><?php echo htmlspecialchars($brochure['description']); ?></p>
        <p class="text-gray-600"><?php echo htmlspecialchars($brochure['company_name']) . " - " .
                                    htmlspecialchars($brochure['year_of_edition']) . " - " .
                                    htmlspecialchars($brochure['quantity_available']) . " disponibles"; ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <h2 class="text-2xl font-bold mb-3">Ajouter une brochure</h2>
  <form action="add_brochure.php" method="post" class="bg-white p-5 rounded shadow">
    <div class="mb-4">
      <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Titre:</label>
      <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
      <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
      <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
    </div>

    <div class="mb-4">
      <label for="company_name" class="block text-gray-700 text-sm font-bold mb-2">Nom de l'entreprise:</label>
      <input type="text" id="company_name" name="company_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
      <label for="year_of_edition" class="block text-gray-700 text-sm font-bold mb-2">Année d'édition:</label>
      <input type="number" id="year_of_edition" name="year_of_edition" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-4">
      <label for="quantity_available" class="block text-gray-700 text-sm font-bold mb-2">Quantité disponible:</label>
      <input type="number" id="quantity_available" name="quantity_available" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <input type="submit" value="Ajouter" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
  </form>
</body>

</html>