<?php
    function fibonacci($count){
        if($count <= 0) return [];
        if($count == 1) return [1];
        if($count == 2) return [1,1];

        $out = [1,1];
        for($i = 2; $i<=$count; $i++)
            $out[] = $out[$i-1] + $out[$i-2];

            return $out;
    }

    $fib_count = 10;

    foreach(fibonacci($fib_count) as $key => $val){
        if($key%2!=0)
            echo "$key."." $val\n";
    }
?>