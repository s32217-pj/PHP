<?php 

$DB_NAME = "Cars";
$db = mysqli_connect("localhost", "root", "");
if(!$db)
    exit("Unable to connect to the database!");

if(!mysqli_select_db($db, "cars")){
    mysqli_close($db);
    exit("Unable to select Cars databse");
}


$cars = [];
$count = 5;
$query = 'SELECT * from samochody LIMIT 5';
$result = mysqli_query($db, $query);

while($car = mysqli_fetch_assoc($result))
    $cars[] = $car;
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samochody</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"
</head>
<body class="bg-dark text-light mb-5">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Samochody</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Strona główna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all_cars.php">Wszystkie samochody</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_car.php">Dodaj samochód</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Witaj na stronie o samochodach!</h1>
        <p>Wybierz zakładkę, aby rozpocząć.</p>

            <?php if (!empty($cars)): ?>
                <table class="table table-dark table-striped mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Marka</th>
                            <th>Model</th>
                            <th>Cena</th>
                            <th>Rok</th>
                            <th>Opis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cars as $car): ?>
                            <tr>
                                <td><?= htmlspecialchars($car['id']) ?></td>
                                <td><?= htmlspecialchars($car['marka']) ?></td>
                                <td><?= htmlspecialchars($car['model']) ?></td>
                                <td><?= htmlspecialchars($car['cena']) ?></td>
                                <td><?= htmlspecialchars($car['rok']) ?></td>
                                <td><?= htmlspecialchars($car['opis']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Brak samochodów do wyświetlenia.</p>
            <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
