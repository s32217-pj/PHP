<?php
    $arr =["jabłko", "banan", "pomarańcza"];
    foreach($arr as $f){
        echo "Rev ";
        for($i = strlen($f)-1; $i>=0; $i--){
            echo "$f[$i]";
        }

        if(str_starts_with($f,"p"))
           echo " Zaczyna się na literę p";
        else 
            echo "\n";
    }
?>