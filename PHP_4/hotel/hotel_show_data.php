<?php
include 'login_utils.php';

error_reporting(E_ERROR | E_PARSE); //show only normal errors and parsing errors. Otherwise we will get warning if file does not exist, which we handle
require_login();

$csvData = null;
$error = null;


$file = fopen("reservations.csv", "r");

if (!$file) {
    $error = "File could not be opened, or reservations.csv file does not exist";
    goto end; //return stops execution of script, this will go to the end and website will render
}

if (filesize("reservations.csv") == 0) {
    $error = "reservations.csv file is empty!";
    goto end; //return stops execution of script, this will go to the end and website will render
}

while (($data = fgetcsv($file, separator: ';')) !== false)
    $csvData[] = $data;

end:
 //end of the script
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="bg-light py-5">

    <!-- If some error occured display it here-->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <strong>Error!</strong> <?php echo ($error); ?>
        </div>
    <?php endif; ?>

    <?php if (!isset($error)): ?>

        <div class="container">
            <h1 class="text-center mb-4">Reservations Data</h1>

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <?php
                        $headers = $csvData[0]; //The first row is the header row
                        foreach ($headers as $header):
                            ?>
                            <th><?php echo ($header); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Iterate through the CSV data
                    for ($i = 1; $i < count($csvData); $i++):
                        $data = $csvData[$i];
                        ?>
                        <tr>
                            <?php foreach ($data as $value): ?>
                                <td><?php echo ($value); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>

    <?php endif; ?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gybPyzHaLF8OeQWlRkxz9NOzJbW8PpI+8ytF5z6Lg5BxZp+ch7"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-pzjw8f+ua7Kw1TIq0pWv8F1b+ZZFhUAD6zX6pFzZXgH9LMktlbt3V+Fpm7IfX12f"
        crossorigin="anonymous"></script>
</body>

</html>