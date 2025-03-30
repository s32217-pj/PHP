<?php
session_start();
$errors = [];
if (isset($_SESSION['errors']))
    $errors = $_SESSION['errors'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test save to file</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light py-4">

    <div class="container">
        <h2 class="text-center mb-4">Form Submission</h2>

        <!-- Display errors here -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="save.php" method="post">
            <div class="mb-3">
                <label for="form-text" class="form-label">Enter your text:</label>
                <textarea name="text" id="text" class="form-control" cols="50" rows="10"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <!-- Add Bootstrap JS and Popper.js for full functionality (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gybPyzHaLF8OeQWlRkxz9NOzJbW8PpI+8ytF5z6Lg5BxZp+ch7"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-pzjw8f+ua7Kw1TIq0pWv8F1b+ZZFhUAD6zX6pFzZXgH9LMktlbt3V+Fpm7IfX12f"
        crossorigin="anonymous"></script>
</body>

</html>