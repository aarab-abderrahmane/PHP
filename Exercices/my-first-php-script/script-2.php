<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <h1><?php echo "Welcome to PHP!" ?></h1>

    <!-- variables -->
    <?php 
        $name = "abderrahmane";
        $age = 18;
        echo "My name is $name and i am $age years old."
    ?>

    <!-- Data types in PHP  -->
    <?php 
    $integer = 10;
    $float = 3.14;
    $string = "hello";
    $boolean = true ;


    $age = 18 ;
    var_dump(value:$age);
    
    ?>


    <!-- comments -->
    
    <?php
        //this is comment 
        #this is comment 
        /* this is comment 
            ok
        */
    ?>

    <!-- PHP Opearation  -->
        <!-- arithmetic Opearation -->


    <?php
    
    $a = 10;
    $b = 5;
    echo $a + $b , "  |  ";
    echo $a * $b , "  |  "; 
    echo $a / $b , "  |  ";
    echo $a ** $b , "  |  ";
    echo $a % $b , "  |  ";
    ?>

        <!-- assignment operators  -->

    <?php
    
     $x = 10;
     $x +=5;
     echo $x;
    ?>

        <!-- comparison operators  -->

    <?php 
    
        var_dump(10== "10");
        var_dump(10==="10");
        var_dump(10!=5);
        var_dump(10>5);
        var_dump(10<5);
    ?>

        <!-- logical operators  -->
    
    <?php 

        $a=true ; 
        $b=false;
        $c= false;

        var_dump($a && $b);
        var_dump($a || $b);
        var_dump($a || $c);
        var_dump(!$a);

    ?>

        <!-- conditional statements -->
    
    <?php 
    
        $age = 18;
        if($age >=18){
            echo "You are an adult!";
        }
    ?>

    <?php 
    
        $age = 16;
        if($age >=18){
            echo 'you are an adult!';
        }else{
            echo 'you are a minor!';
        }
    ?>

    <?php 
    
        $score = 85;
        if($score >=90){
            echo "Garde : A";
        }elseif ($score >=80){
            echo "Garde : B";
        }else if ($score >=70){
            echo "Garde : C";
        }else{
            echo "Garde : F";
        }
    ?>

    <?php 
    
        $age = 20;
        echo ($age >=18) ? "Adult" : "Minor" ;         
    ?>

    <?php 
    
        $day =  "Monday";

        switch ($day){

            case "Monday": 
                echo "it's the start of the week!";
                break ;
            
            case "Friday":
                echo "weekend is coming!";
            
            default : 
                echo "just another day.";
        }
    ?>


</body>
</html>