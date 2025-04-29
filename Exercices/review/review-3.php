<?php

    echo "1"+"3"."<br>";

    $var = implode("-", ["a", "b", "c"]);
    echo $var."<br>";

    $filter_string = filter_var("<b>Bonjour</b>", FILTER_SANITIZE_STRING);
    echo $filter_string ."<br>";

    $filter_url = filter_var("http://exemple.com", FILTER_VALIDATE_URL);  // if true --> url | else : null 
    echo $filter_url ."<br>";

    $explode = explode("-", "2025-04-25");
    echo print_r($explode) ."<br>";

    $implode = implode("-", []);
    echo $implode ."<br>";

    $implode_2 =  implode(["a", "b", "c"]); // by default remove the comma
    echo $implode_2 ."<br>";  

 


?>