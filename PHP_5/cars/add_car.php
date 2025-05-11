<?php
$DB_NAME = "Cars";
$db = mysqli_connect("localhost", "root", "");
if(!$db)
    exit("Unable to connect to the database!");

if(!mysqli_select_db($db, "cars")){
    mysqli_close($db);
    exit("Unable to select Cars databse");
}

// === Handle form submission ===
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $cena = $_POST['cena'];
    $rok = $_POST['rok'];
    $opis = $_POST['opis'];

    $statement = mysqli_prepare($db, "INSERT INTO samochody (marka, model, cena, rok, opis) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement,"ssdss", $marka, $model, $cena, $rok, $opis);

    if(mysqli_execute($statement))
        $message = "Samochód został dodany pomyślnie!";
    else 
        $message = "Błąd przy dodawaniu samochodu: ".mysqli_error($db);
    

    mysqli_stmt_close($statement);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj Samochód</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light mb-5">

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
                        <a class="nav-link active" href="#">Dodaj samochód</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php if ($message): ?>
            <div class="alert alert-info" role="alert">
                <?= htmlspecialchars($message) ?>
            </div>
    <?php endif; ?>

    <div class="container mt-4">
        <h1 class="mb-4">Dodaj nowy samochód</h1>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="marka" class="form-label">Marka</label>
                <input type="text" class="form-control" id="marka" name="marka" required>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model" required>
            </div>
            <div class="mb-3">
                <label for="cena" class="form-label">Cena</label>
                <input type="number" class="form-control" id="cena" name="cena" required step="0.01">
            </div>
            <div class="mb-3">
                <label for="rok" class="form-label">Rok</label>
                <input type="number" class="form-control" id="rok" name="rok" required min="1900" max="2099">
            </div>
            <div class="mb-3">
                <label for="opis" class="form-label">Opis</label>
                <textarea class="form-control" id="opis" name="opis" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Dodaj samochód</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
