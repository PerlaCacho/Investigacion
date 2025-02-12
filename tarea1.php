<?php
// Nombre: Perla Nazareth Cacho Gonzalez - 0203200400175
require_once "conexion.php";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Connected to $dbname at $host successfully.";

    // Consulta para obtener las 5 peliculas mas rentadas
    $consultaPeliculas = "SELECT f.title, COUNT(r.rental_id) AS rental_count FROM film f INNER JOIN inventory i ON f.film_id = i.film_id INNER JOIN rental r ON i.inventory_id = r.inventory_id GROUP BY f.title ORDER BY rental_count DESC LIMIT 5";

    $Peliculas = $conn->query($consultaPeliculas);
    $peliculas = $Peliculas->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tarea 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
   <div class="cotainer mt-5">
       <h1 class="text-center">5 Películas Más Rentadas</h1>
       <ul class="list-group mt-4">
           <?php foreach ($peliculas as $pelicula): ?>
               <li class="list-group-item d-flex justify-content-between align-items-center">
                   <?php echo $pelicula['title']; ?>
                   <span class="badge bg-primary rounded-pill">Las veces que se algulo: <?php echo $pelicula['rental_count']; ?> veces.</span>
               </li>
           <?php endforeach; ?>
       </ul>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

   </div>
</body>
</html>
