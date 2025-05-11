<?php 

$DB_NAME = "Cars";
$db = mysqli_connect("localhost", "root", "");
if(!$db)
    exit("Unable to connect to the database!");

if(!mysqli_select_db($db, "cars")){
    mysqli_close($db);
    exit("Unable to select Cars database");
}

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    $statement = mysqli_prepare($db, 'SELECT * FROM samochody WHERE id = ?');
    mysqli_stmt_bind_param($statement,"i", $car_id);

    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    
    if($result)
        $car = mysqli_fetch_assoc($result);
    else
        exit("Samochód z id: ".$car_id." nie istnieje");


} else {
    exit("ID samochodu nie zostało podane.");
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Szczegóły samochodu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Samochody</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Strona główna</a>
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
        <h1 class="mb-4">Szczegóły samochodu</h1>

        <?php if (isset($car)): ?>
            <table class="table table-dark table-bordered">
                <tr>
                    <th>ID</th>
                    <td><?= htmlspecialchars($car['id']) ?></td>
                </tr>
                <tr>
                    <th>Marka</th>
                    <td><?= htmlspecialchars($car['marka']) ?></td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td><?= htmlspecialchars($car['model']) ?></td>
                </tr>
                <tr>
                    <th>Cena</th>
                    <td><?= htmlspecialchars($car['cena']) ?></td>
                </tr>
                <tr>
                    <th>Rok</th>
                    <td><?= htmlspecialchars($car['rok']) ?></td>
                </tr>
                <tr>
                    <th>Opis</th>
                    <td><?= htmlspecialchars($car['opis']) ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>Nie znaleziono samochodu.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
