<?php
require_once "conexion.php";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Consulta para Mostrar en una Card El Nombre y Apellido del Usuario de Staff y la Cantidad Total de peliculas rentadas por cada uno de esos usuarios
    $consultaStaff = "SELECT s.first_name, s.last_name, COUNT(r.rental_id) AS rental_count
                      FROM staff s
                      LEFT JOIN rental r ON s.staff_id = r.staff_id
                      GROUP BY s.staff_id";
    $staff = $conn->query($consultaStaff);
    $staff = $staff->fetchAll(PDO :: FETCH_ASSOC);
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tarea 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Películas Rentadas y Usuarios de Staff</h1>
    <div class="row mt-4">
        <?php foreach ($staff as $usuario): ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $usuario['first_name'] . ' ' . $usuario['last_name']; ?></h5>
                        <p class="card-text">Películas rentadas: <?php echo $usuario['rental_count']; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
