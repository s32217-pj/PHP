<?php
    function prime_sieve($range_begin, $range_end){

        if($range_begin < 0 || $range_end < 0)
            return [];
        if($range_begin <= 1) $range_begin=2; //0 and 1 are not primes
    
        $primes = array_fill(0, $range_end +1, true);
        $primes_out = [];

        for($i = 2; $i<=sqrt($range_end);$i++){
            if($primes[$i]){
                for ($j = $i * $i; $j <= $range_end; $j += $i)
                    $primes[$j] = false;
            }
        }

        foreach($primes as $key => $val)
            if($val && $key >= $range_begin) array_push($primes_out, $key);

        return $primes_out;
    }

    $range_begin = 2;
    $range_end = 20;

    foreach(prime_sieve($range_begin, $range_end) as $prime)
        echo "$prime \n";
?>