<?php
// Nombre: Perla Nazareth Cacho Gonzalez - 0203200400175
require_once "conexion.php";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Consulta para obtener la cantidad de películas por categoría
    $consultaCategorias = "SELECT c.name AS category_name, COUNT(f.film_id) AS total_films
                           FROM category c
                           INNER JOIN film_category fc ON c.category_id = fc.category_id
                           INNER JOIN film f ON fc.film_id = f.film_id
                           GROUP BY c.name";
    $Categorias = $conn->query($consultaCategorias);
    $categorias = $Categorias->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tarea 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Cantidad de Películas por Categoría</h1>
    <table class="table table-striped mt-4">
        <thead>
        <tr>
            <th>Categoría</th>
            <th>Cantidad de Películas Disponibles</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?php echo $categoria['category_name']; ?></td>
                <td><?php echo $categoria['total_films']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
