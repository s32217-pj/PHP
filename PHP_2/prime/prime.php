<!-- Wygląd został wygenerowany przez AI (dodało bootstrapa) -->

<?php 
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Test</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <!-- Form card -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Prime Test</h2>
                        <form action="prime_post.php" method="post">
                            <!-- Input number -->
                            <div class="form-group">
                                <label for="number">Input number</label>
                                <input type="number" name="number" id="number" class="form-control" min="1" required>
                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block">Check if number is prime</button>
                        </form>
                        <!-- Result display -->
                        <div class="mt-4">
                            <?php
                                if (isset($_SESSION['prime'])) {
                                    echo "<div class='alert alert-info'>";
                                    echo "<p><strong>Result:</strong> ".$_SESSION['prime']['output']."</p>";
                                    echo "<p><strong>Iteration count:</strong> ".$_SESSION['prime']['iterations']."</p>";
                                    echo "</div>";
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>