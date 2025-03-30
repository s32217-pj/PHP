<?php
    //tam gdziekolwiek jest obsługa błędów powinienem dodać ustawianie jakiejś wartości w sesji, żeby oznajmić ze zaszedł błąd, żeby go wyswietlic na stronie
    //jednak ten skrypt ma byc prosty, wiec ten etap pomijam

    if(!isset($_POST["text"])) //go to previous page
        header("location:".$_SERVER["HTTP_REFERER"]);

    $text = $_POST["text"];
    $file = fopen("form-text.txt", "w");

    if(!$file) //file could not be opened, go bakc to previous page
        header("location:".$_SERVER["HTTP_REFERER"]);

    fwrite($file, $text);

    fclose($file);

    header("location:".$_SERVER["HTTP_REFERER"]);
?>