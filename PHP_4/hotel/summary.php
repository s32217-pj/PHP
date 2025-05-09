<!--Uwaga! Wygląd strony został wygenerowany CZĘŚCIOWO przez AI, niektóre rzeczy poprawiłem samodzielnie, gdyż wyglądały średnio
 -->

<?php
include 'login_utils.php';

session_start(); //start session to get reservation cookie
require_login();

// Check if reservation data exists in the session
if (!isset($_SESSION['reservation'])) {
    header("Location: hotel.php"); //if there is no reservation cookie, redirect to the hotel page
    exit();
}

$reservation = $_SESSION['reservation'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podsumowanie Rezerwacji</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light py-5">

    <div class="container">
        <h2 class="text-center mb-4">Podsumowanie Rezerwacji</h2>

        <!-- Reservation Summary Card -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title">Szczegóły rezerwacji</h4>

                <div class="row mt-5">
                    <?php
                    foreach ($reservation['people'] as $idx => $person) {
                        echo "<div class='col-12 col-sm-6 col-md-4 col-lg-3 mb-3'>" .
                            "<h5>" . "Osoba " . ($idx + 1) . "</h5>" .
                            "<p>" . $person['name'] . " " . $person['surname'] . "</p>" .
                            "</div>";
                    }
                    ?>
                </div>

                <div class="list-group">
                    <p class="list-group-item"><strong>Ilość osób:</strong>
                        <?php echo htmlspecialchars($reservation['people-count']); ?></p>
                    <p class="list-group-item"><strong>Imię:</strong>
                        <?php echo htmlspecialchars($reservation['name']); ?></p>
                    <p class="list-group-item"><strong>Nazwisko:</strong>
                        <?php echo htmlspecialchars($reservation['surname']); ?></p>

                    <h5 class="mt-4">Adres:</h5>
                    <p class="list-group-item"><strong>Miasto:</strong>
                        <?php echo htmlspecialchars($reservation['address']['city']); ?></p>
                    <p class="list-group-item"><strong>Województwo:</strong>
                        <?php echo htmlspecialchars($reservation['address']['province']); ?></p>
                    <p class="list-group-item"><strong>Ulica, numer domu:</strong>
                        <?php echo htmlspecialchars($reservation['address']['street']); ?></p>
                    <p class="list-group-item"><strong>Kod pocztowy:</strong>
                        <?php echo htmlspecialchars($reservation['address']['postal-code']); ?></p>

                    <p class="list-group-item"><strong>Numer karty:</strong>
                        <?php echo htmlspecialchars($reservation['credit-card']); ?></p>

                    <h5 class="mt-4">Udogodnienia:</h5>
                    <p class="list-group-item"><strong>Łóżko dla dziecka:</strong>
                        <?php echo $reservation['child-bed'] ? 'Tak' : 'Nie'; ?></p>
                    <p class="list-group-item">
                        <?php
                        if (!empty($reservation['addons']))
                            echo implode(', ', $reservation['addons']);
                        else
                            echo "Brak";
                        ?>
                    </p>
                </div>

                <div class="text-center mt-4">
                    <a href="hotel.php" class="btn btn-primary">Wróć do formularza</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha256-CjSoeELFOcH0/uxWu6mC/Vlrc1AARqbm/jiiImDGV3s=" crossorigin="anonymous"></script>
</body>

</html>