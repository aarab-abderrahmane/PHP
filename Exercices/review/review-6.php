<!--Variables and their naming rules -->
<?php
echo "hello wolrd\n";

$Var = "1";
$var = "2";
$_="3";
$_4 = "4";

echo "$var  |  $Var  |  $_  | " ;


?>

<!-- Data Types -->
<?php

    // string 
    // integer
    // float / double 
    // boolean
    // array []
    // object {}
    // null 

?>

<!-- operations -->
<?php

    $a = 10 ;
    $b = 3 ;
    echo $a * $b;
    echo $a / $b ;
    echo $a % $b ;
    echo "\n";



    $text = "hello";
    $text .= " world\n";  // + don't work not a number
    echo $text;



?>

<!-- Conditional Operations -->
<?php 

    $a = 10 ;
    $b = 2;

    if($a>$b) { echo "hello\n";}

    // switch 

    $grade = "A";

    switch($grade){
        case 'A' : 
            echo "Excellent \n";
            // break ;

        case 'B':
            echo "nice \n" ; 
            break ; 
        
        default : 
            echo "UNknown grade \n";
    }


    // for loop 
    for ($i=0 ; $i<$a ; $i++){
        echo "$i \n";
    }

    // while loop 

    $i = 0 ;
    while ($i<5){
        echo "$i , " ;
        $i++;
    }

    echo "\n";

    // foreeach 
    $fruits = ['apple','banana','orange'];
    foreach($fruits as $fruit){
        echo $fruit==="orange" ? "$fruit" : "$fruit + ";

    }

    echo "\n"; 
    $obj = ['name'=>'abdu','age'=>18];
    foreach($obj as $key => $value){
        echo "$key -> $value\n";
    }


?>


<!--  functions -->

<?php

    function  sayHello($name){
        return "Hello, $name";
    }

    echo sayHello('abderrahmane')

?>

<!-- Static Functions -->
<?php

    function counter(){
        static $count = 0 ;
        echo "$count  , " ; 
        $count++ ; 

    }

    counter();
    counter();
    counter()
?>


<!-- variables scope -->*
<?php

    // local variable
    function myfunction(){
        $localVar = "local variable";
        echo $localVar ; 
    }

    myfunction();

    // echo $localVar; // error


    //global varibale 
    $globalVar = "\nglobal variable";
    function showGlobal(){
        // echo $globalVar; => error
        global $globalVar ;
        echo $globalVar;
    }

    showGlobal();
    $globalVar = "\nthis is global variable";
    showGlobal()


    // static => there is no external access
    // global => external access 


?>


<!--  Date --> 
<?php

    $date_now = new DateTime();
    echo "Current Date : ".$date_now->format("Y-m-d");
    echo "\nYear : ".$date_now->format("Y") ; // year 4 digits
    echo "\nYear : ".$date_now->format("y") ; // year 2 digits
    echo "\nmonth : ".$date_now->format("m"); // if 0<x<10 add 0 
    echo "\nmonth : ".$date_now->format('n'); // no adding 0 
    echo "\nmonth : ".$date_now->format('F'); // full month name
    echo "\nDay : ".$date_now->format('d');


    // change date manually 
    $date_now->setDate(2023,12,25);
    echo "\n".$date_now->format('Y-m-d');
    $date_now->modify('+1 week');
    $date_now->modify('-3 days');



?>


<!--  functions -->
<?php

    echo "\n".strlen('hello');
    echo "\n".strpos("hello world","world"); //index of position
    echo "\n".strtolower('HEllO');
    echo "\n".strtoupper('heLLo');
    echo"\n".trim('    space    ');
    $array = explode(',',"a,b,c") ;// convert to array ['a','b','c']
    echo "\n".implode(',',['a.n','b'])

?>


<!-- Programmation orientée object POO -->
<?php

    //héritage 
    class Vehicle { // parent class

        public function move(){

            echo "\nMoving ..";

        }

    };


    class Car extends vehicle {  // child class
        public function drive(){
            echo "\nCar is driving .";
        }
    }



    $car = new Car();
    $car->move(); // inherited from vehicule
    $car->drive();


?>

<?php

    // polymorphisme 

    class Animal {
        public function makeSound(){
            echo "Some sound\n";

        }
    }

    class Dog extends Animal {
        public function makeSound(){
            echo "woof!\n";
        }
    }

    class Cat extends Animal {
        public function makeSound(){
            echo "Meow!\n";
        }
    }

    function animalSound(Animal $animal){  // it must be defined inside the class first
        
        $animal->makeSound();

    }


    animalSound(new Dog());
    animalSound(new Cat());
    animalSound(new Animal())

?>


<?php

    // Encapsulation 
    class BankAccount {

        private $balance = 0 ;
        public function deposit($amount){
            if ($amount > 0){
                $this->balance += $amount;
            }
        }

        public function getBalance(){
            return $this->balance;
        }

    }

    $account = new BankAccount();
    $account->deposit(200);
    $account->deposit(200);

    echo $account->getBalance()

?>



<?php

    // Abstraction 
    abstract class Shape {
        abstract public function area(); // *it should be applied in all classes.
    }

    class Rectangle extends Shape{
        private $width ; 
        private $height ; 

        public function __construct($width,$height){
            $this->width=$width;
            $this->height=$height;
        }

        public function area(){
            return $this->width * $this->height;
        }
    }

    $rect = new Rectangle(5,10);
    echo $rect->area()

?>