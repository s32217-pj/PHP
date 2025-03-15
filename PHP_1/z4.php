<?php
    $text ="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
            galley of type and scrambled it to make a type specimen book. It has survived not only five
            centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
            popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
            and more recently with desktop publishing software like Aldus PageMaker including versions of
            Lorem Ipsum.";

    $words = explode(" ", $text);

    for($i =0; $i<count($words);$i++)
        $words[$i] = trim($words[$i]); //trim newlines

    $words = array_filter($words, function($val){
        return $val!=="";
    }); //filter out empty strings
    
    $words = array_values($words); //reindex

    $arr_len = count($words)-1;
    $idx =0;

    while($idx < $arr_len){
        if(ctype_punct(substr($words[$idx],-1))){

            for ($j = $idx; $j < $arr_len ; $j++) {
                $words[$j] = $words[$j + 1];
            }

            array_pop($words);
            $arr_len--;
            continue;
        }

        $idx++;
    }

    $asc_arr = [];

    //traktuje 0 element jako pierwszy -> nieparzysty, więc wszystkie elementy z kluczem parzystym są dla mnie nieparzyste
    for($i=0;$i<$arr_len;$i+=2){
        if($i+1 > $arr_len)
            break;

        $asc_arr[$words[$i]] = $words[$i+1];
    }


    foreach($asc_arr as $key => $val)
        echo "Key: $key -> Val: $val \n";
?>