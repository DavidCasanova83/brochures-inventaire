<!DOCTYPE html>
<html>

<head>
  <title>Ajouter une Brochure</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-5">
  <form action="add_brochure.php" method="post" class="bg-white p-5 rounded shadow">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold">Ajouter une Brochure</h1>
      <a href="index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Retour</a>
    </div>
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