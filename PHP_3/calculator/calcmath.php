<?php 
    function add($n1, $n2){
        return $n1 + $n2;
    }

    function sub($n1, $n2){
        return $n1-$n2;
    }

    function multiply($n1, $n2){
        return $n1*$n2;
    }

    function divide($n1, $n2){
        if($n2==0)
            return INF;
        return $n1/$n2;
    }
?>