<?php

    class DatabaseManager{

        private $conn ; 
        private $columns ;
        private $table_name;
        private $db_name ; 
        public function __construct($db_name,$table_name,$columns_array){
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $this->$db_name = $db_name;
            $this->columns=$columns_array;
            $this->table_name  = $table_name;

            $this->conn = new mysqli("localhost",'root','',"");
            $this->conn->query("CREATE DATABASE IF NOT EXISTS $db_name");
            $this->conn->select_db($db_name);


            $sql =  "CREATE TABLE IF NOT EXISTS $table_name (";
            $index=1;
            foreach($columns_array as $col=>$type){
                if($index===1){
                    $sql.="$col $type PRIMARY KEY AUTO_INCREMENT,";

                }elseif($index < count($columns_array)){
                    $sql.="$col $type NOT NULL ,";
                }else{
                    $sql.="$col $type NOT NULL )";
                }

                $index+=1;
            }

            echo $sql;

            $this->conn->query($sql);


        }

        // public function Add($fname,$lname,$age,$image){
            
            

        // }

    };


    $stagiaire_db = new DatabaseManager("Person","Stagiare",['code'=>"INT",'fname'=>'VARCHAR(20)','lname'=>'VARCHAR(10)','age'=>'INT',"image"=>"BLOB"])

?>

