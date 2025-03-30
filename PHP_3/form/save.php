<?php
    //tam gdziekolwiek jest obsługa błędów powinienem dodać ustawianie jakiejś wartości w sesji, żeby oznajmić ze zaszedł błąd, żeby go wyswietlic na stronie
    //jednak ten skrypt ma byc prosty, wiec ten etap pomijam

    session_start();
    $_SESSION['errors']=null;

    if(!isset($_POST["text"]) || empty($_POST["text"])) //go to previous page
    {
        $_SESSION['errors'] = ["Text was not set during post request"];
        header("location:".$_SERVER["HTTP_REFERER"]);
    }

    $text = $_POST["text"];
    $file = fopen("form-text.txt", "w");

    if(!$file) //file could not be opened, go bakc to previous page
    {
        $_SESSION['errors'] = ["Error: File could not be opened"];
        header("location:".$_SERVER["HTTP_REFERER"]);
    }

    fwrite($file, $text);
    fclose($file);

    header("location:".$_SERVER["HTTP_REFERER"]);
?>