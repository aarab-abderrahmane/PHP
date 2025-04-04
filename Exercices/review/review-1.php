<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        body{
            background-color: black;
            color:white;
        }
    </style>
</head>
<body>
    
    <form method="post" >
        <input type="text" name="text">
        <button type="submit">Send</button>
    </form>

</body>
</html>

<?php 

    echo "hello world!"; 
    
    $name = "abdulrahman";
    $price = 10;
    echo "hello {$name}";
    echo "<br>your pizza is \${$price}";

    #functions 

    if ( isset( $_POST['text'] ) && $_POST['text'] ) {
        $number = $_POST['text'];
        echo "<br>".round($number)."(round)<br>";
        echo ceil($number)."(ceil)<br>";
        echo floor($number)."(floor)<br>";
        echo abs($number)."(abs '-' -> '+')<br>";

        echo sqrt($number)."(sqrt)<br>";
        echo pow($number,2)."(pow '**') ex **2<br>";
        echo max($number,10,-10)." , max(this number,10,-10)<br>";
        echo min($number,10,-10)." , max(this number,10,-10)<br>";
        echo pi()." (PI==3.14)<br>";
        echo rand(0,10)."rand(choose around between two number  ex 0-10 )";

        

        //round : if the number aftr "." >=5 one is added to the number befor "."  if <5 the part after the "." is being removed
        //floor : (always down) delete the part after "." if the number is positive else one is added and delete last part
        //ceil : (always up) added one and delete last part if the number is positive "+" else delete last part 

    
    }
    

?>