<!-- 📝 Exercise 1:
Create a class called Person.

Add two properties: name and age.

Add a method greet() that says: "Hello, my name is NAME".

Create an object from the class and test it -->

<?php

    // In PHP OOP, public is a visibility keyword. It tells PHP who is allowed to access a property or method.

    // There are 3 types of visibility:
    // Visibility	Meaning
    // public	Can be accessed from anywhere (inside or outside the class). ✅
    // private	Can be accessed only inside the class. ❌
    // protected	Can be accessed inside the class and subclasses. 🟡


    #class
    class Person{

        #properties :
        public $name = "abderrahmane";
        public $age = 18;

        #method :
        public function greet(){
                echo "Hello , my name is ".$this->name;
        }

    }

    #object 
    $me = new Person();
    #without constructor
    $me->name="aarab abderrahmane";
    $me->greet();


?>



<!-- with constractor -->
<?php

    echo "<br><br>";

    // 📝 Exercise 2:
    // Create a class Book

    // Add properties: title, author

    // Use a constructor to set the values when creating the object

    // Add a method display() that prints:
    // "The book TITLE is written by AUTHOR"

    class Book{

        public $title ;
        public $author;

        public function __construct($title_input,$author_input){

            $this->title=$title_input;
            $this->author=$author_input;

        }

        public function display(){
            echo "The book \"" . $this->title . "\" is written by " . $this->author . ".";
        }

    }

    $book1 = new Book("Harry Potter","J.K. Rowling");
    $book1->display();



?>

<!-- Encapsulation -->
<?php
    echo "<br><br>";

    // 🔐 What is Encapsulation?
    // Encapsulation means hiding internal data of an object and controlling access to it using methods.

    
    //📝 Exercise 3:
    // Create a class User

    // Add private properties: username and email

    // Use a constructor to set their values

    // Create:

    // getUsername() method

    // setUsername($newUsername) method that only changes it if it’s not empty

    // Create a user and change the username using the setter, then display the new one using the getter.


    class User{

        #properties :
        private $username;
        private $email;

        #methods : 
        public function __construct($username,$email){
            $this->username = $username;
            $this->email = $email;

        }

            #getter
        public function getUsernamme(){

            return "the username is ".$this->username;

        }

            #setter
        
        public function setUsername($newUsername){
            if(!empty($newUsername)){
                $this->username=$newUsername;
                return "username changed successfully!";

            }else{
                return "the name is empty";
            }
        }

    }

    $user1 = new User("aarab","abdu@gmail.com");
    echo $user1->getUsernamme();
    echo '<br>'.$user1->setUsername("abderrahmane");
    echo '<br>'.$user1->getUsernamme();


?>


<!-- to string function -->

<?php

    class stagiaire{

        #properties :

        public $code;
        public $nom;
        public $prenom;
        public $age;

        #methods :
        public function __construct($code,$nom,$prenom,$age){

            $this->code=$code;
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->age=$age;

        }

        public function getter(){
            return "code : ".$this->code." nom: ".$this->nom." prenom: ".$this->prenom." age: ".$this->age;
        }

        public function setter($new_code,$new_nom,$new_prenom,$new_age){

            $this->code=$new_code;
            $this->nom=$new_nom;
            $this->prenom=$new_prenom;
            $this->age=$new_age;

        }

        public function __toString(){
            return "code : ".$this->code." nom: ".$this->nom." prenom: ".$this->prenom." age: ".$this->age;
        }

    }

    $stagiaire1= new stagiaire("1","arab","abderrahmane","18");
    echo '<br>'.$stagiaire1 ; #with toString function automatically
    
    $stagiaire1->setter("1","aarab","abderrahmane","18");
    echo '<br>'.$stagiaire1 ; #with toString function automatically


?>