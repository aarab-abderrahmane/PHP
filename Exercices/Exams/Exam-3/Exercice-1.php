<?php


    class DateNaissance{

        public $jour ;
        public $mois ;
        public $année;

        public function __construct($jour,$mois,$année){

            $this->jour=$jour;
            $this->mois=$mois;
            $this->année=$année;


        }

        public function __toString(){
            
            $date = ''.$this->année.'-'.$this->mois.'-'.$this->jour.'';
            $date_naissance = new DateTime($date) ;
            
            return $date_naissance->format('Y-m-d');

        }

    }


    class Personne{

        public $nom;
        public $prénom;
        public $date_naissance;

        public function __construct($nom,$prénom,DateNaissance $date_naissance){  

            // DateNaissance $date_naissance ???
            // The parameter must be an object of the DateNaissance class.
            // So you need to create a DateNaissance object first, then pass it when creating a Personne.

            $this->nom=$nom;
            $this->prénom=$prénom;
            $this->date_naissance=$date_naissance;


        }

        //polumorphism (afficher function ) : ✔️ Happens when multiple classes have the same method name but do different things.


        public function Afficher(){
            echo '
                <br>
                <p><b>nom : </b>'.$this->nom.'<p>
                <p><b>prénom : </b>'.$this->prénom.'<p>
                <p><b>date de  : </b>'.$this->date_naissance.'<p>
                <br>
            ';

            

        }


    }

    class Employé extends Personne{  //employé inherits from person

        public $salaire ;

        public function __construct($nom,$prénom,DateNaissance $date_naissance,$salaire){
            parent::__construct($nom,$prénom,$date_naissance);
            $this->salaire=$salaire;
        }

        public function Afficher(){
            echo '
                <br>
                <p><b>nom : </b>'.$this->nom.'<p>
                <p><b>prénom : </b>'.$this->prénom.'<p>
                <p><b>date de naissance : </b>'.$this->date_naissance.'<p>
                <p><b>salaire : </b>'.$this->salaire.'</p>
                <br>
            ';
        

            

        }

        public function __tostring(){
            return '
                <br>
                <p><b>nom : </b>'.$this->nom.'<p>
                <p><b>prénom : </b>'.$this->prénom.'<p>
                <p><b>date de naissance : </b>'.$this->date_naissance.'<p>
                <p><b>salaire : </b>'.$this->salaire.'</p>
            ';
        }

    }

    
    class Chef extends Employé {

        public $service ;

        public function __construct($nom,$prénom,DateNaissance $date_naissance,$salaire,$service){
                parent::__construct($nom,$prénom,$date_naissance,$salaire);
                $this->service=$service;

        }

        public function Afficher(){
            echo ''.parent::__tostring().'<p><b>service : </b>'.$this->service.'</p><br>';
        }
    }

    $presonne1= new Personne("Nadia","lahsen",new DateNaissance(1,1,2004));
    $employe1 = new Employé("sara",'ben',new DateNaissance(10,6,2000),8000);
    $chef = new Chef("aarab","abderrahmane",new DateNaissance(2,4,2006),12000,'informatique');

    $chef->Afficher();


?>