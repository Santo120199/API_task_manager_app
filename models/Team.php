<?php

    class Team {
        private $conn;
        private $table = 'team';

        //Team properties
        public $name;
        public $createdBy;

        //consturct with db
        public function __construct($db){
            $this->conn = $db;
        }

        //Create New Team
        public function createTeam(){
            //query
            $query = 'INSERT INTO '.$this->table .'
            SET 
                name = :name,
                createdBy = :createdBy
            ';

            //prepare the statment
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->createdBy = htmlspecialchars(strip_tags($this->createdBy));

            //Bind Param
            $stmt->bindParam(':name',$this->name);
            $stmt->bindParam(':createdBy',$this->createdBy);

            //execute query
            if($stmt->execute()){
                return true;
            }
            printf("Error: %s.\n",$stmt->error);
            return false;
        }




    }



?>