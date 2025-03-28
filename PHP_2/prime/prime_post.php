<?php

if($_SERVER["REQUEST_METHOD"]!="POST") //only post request are supported
    return;

    $number = $_POST['number'];
    $output = null;
    $iter_count=0;

    if(!is_numeric($number) || $number < 2){
        $output="Wrong input!";
        goto save_session; //przepraszam za użycie goto, mogłem napisać funkcję do zapisywania sesji, ale w tym przypadku nie ma to większego znaczenia
    }

    for($i=2; $i<=sqrt($number); $i++){
        if($number % $i == 0){
            $output=$number." is not prime number";
            $iter_count=$i-2;
            goto save_session;
        }
    }

    $output=$number." is prime number";
    $iter_count = ceil(sqrt($number))-2;


save_session:
    session_start();
    $_SESSION['prime'] = [
        'output' => $output,
        'iterations' => $iter_count
    ];
    header("Location: " . $_SERVER['HTTP_REFERER']); //go back to previous page 
?>