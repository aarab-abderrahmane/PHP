<?php



    $foods = ['abbdulrahman','hello'];

    echo $foods[1];
    echo $foods[1],'<br>';

    $animals = array('Dog','Tiger','Eleephant','Zebar','Monkey','Hourse','Bear');
    array_push($animals,'Deer',"Lion");//add one or more element to array
    $animals[]='Tiger' ; //add only one element
    array_pop($animals); # delete last element
    array_shift($animals) ;// delete first element;
    $animals = array_reverse($animals);
    
    echo 'animals = [';
    foreach($animals as $animal){
        if ($animal === end($animals)){
            echo $animal;
        }else{
            echo $animal,',';
        }
    }
    echo ']'; 
    echo '<br>'. $animals[count($animals)-1];



    $capitals = array(
        'US'=>'United States',
        'MA'=>'Morocco',
        'FR'=>'France'
    );

    echo '<br>',$capitals['US'];
    $capitals['AL']="ALgerian";  // add
    echo '<br>'. $capitals['AL'].'<br>';

    array_pop($capitals);
    //array_shift

    $keys=array_keys($capitals) ;
    print_r($keys);
    echo'<br>';

    $values=array_values($capitals) ;
    print_r($values);
    echo'<br>';

    print_r($capitals);
    echo '<br>';

    $flipped = array_flip($capitals);
    print_r($flipped);
    echo '<br>';

    print_r(array_reverse($flipped));
    echo '<br>';
    // count

    foreach ($capitals as $key => $value){
        echo 'key : ',$key,' | value : ',$value,'<br>';
    }

?>