<!--Uwaga! Wygląd strony został wygenerowany przez AI, w zadaniu nic nie jest napisane o wyglądzie, a bardzo nie chciało mi się pisać go od początku
 Najpierw napisałem kod, potem poprosiłem, aby upiększyło stronę przy użyciu bootstrapa
 -->

<?php
$result = null;
$errorMessage = '';

$num1 = isset($_POST['num1']) ? $_POST['num1'] : '';
$num2 = isset($_POST['num2']) ? $_POST['num2'] : '';
$operation = isset($_POST['operation']) ? $_POST['operation'] : '';

if (is_numeric($num1) && is_numeric($num2)) {
    switch ($operation) {
        case '+':
            $result = $num1 + $num2;
            break;
        case '-':
            $result = $num1 - $num2;
            break;
        case '*':
            $result = $num1 * $num2;
            break;
        case '/':
            if ($num2 != 0)
                $result = $num1 / $num2;
            else
                $errorMessage = "Cannot divide by zero!";
            break;
        default:
            $errorMessage = "Operation is not valid";
    }
} 
else
    $errorMessage = "Numbers are not valid";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light py-5">
    <div class="container">
        <h1 class="text-center mb-4">Calculator</h1>

        <form method="POST" action="calculator.php" class="bg-white p-4 rounded shadow-sm">
            <div class="form-group">
                <label for="num1">Number 1:</label>
                <input type="number" id="num1" name="num1" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="num2">Number 2:</label>
                <input type="number" id="num2" name="num2" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="operation">Operation:</label>
                <select name="operation" id="operation" class="form-control" required>
                    <option value="+">+</option>
                    <option value="-">-</option>
                    <option value="*">*</option>
                    <option value="/">/</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Calculate</button>
        </form>

        <h2 class="mt-4 text-center">
            <?php
                if ($result !== null)
                    echo "<div class='alert alert-success'>Result: " . $result . "</div>";
                else if ($errorMessage != '')
                    echo "<div class='alert alert-danger'>Error: $errorMessage</div>";
            ?>
        </h2>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.5/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
