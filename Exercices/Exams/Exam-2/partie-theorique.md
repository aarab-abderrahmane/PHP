# 1 :
-> C

# 2 :
### un site web statique : 
est un site statique affiche un contenu fixe , identique pour tous les visiteurs


### un site web dynamique :
est un site dynamique génere du contenu automatiquement selon les actions de l'autilisateur

# 3 :
c'est une variable spéciale en PHP  qui permet de récupérer les valeurs envoyées par un formaulaire html utilisant le méthode POST 


# 4 : 
empty() est un fonction qui return "true" si le variable est  vide sinon "false "

ex :
<
$x="";
if(empty($x)){
    echo "vide";
}else{
    echo " non vide ";
}
>

# 5 :

'Dev'-'Dev'-'Dev'-'Dev'-'101'-'102-'...

# Exercice  2 :


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