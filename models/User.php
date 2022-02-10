<?php

    class User {
        private $conn;
        private $table = 'user';

        //User properties
        public $username;
        public $email;
        public $password;

        //constuctor with db
        public function __construct($db){
            $this->conn = $db;
        }

        //Register User
        public function register(){

            //check for the user in the db
            if($this->isAlreadyExist()){
                return false;
            }

            //create query
            $query = 'INSERT INTO '. $this->table. '
            SET
                username = :username,
                email = :email,
                password = :password
            ';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));

            //Bind param
            $stmt->bindParam(':username',$this->username);
            $stmt->bindParam(':email',$this->email);
            $stmt->bindParam(':password',$this->password);

            //execute query
            if($stmt->execute()){
                return true;
            }

            //print error
            printf("Error %s.\n",$stmt->error);

            return false;
        }

        //login user
        function login(){

            //create query
            $query = 'SELECT * FROM '. $this->table . '
            WHERE 
                email = ? AND password = ?
            ';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));
    
            //Bind param
            $stmt->bindParam(1,$this->email);
            $stmt->bindParam(2,$this->password);
           
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row == null){
                return false;
            }

            //set property
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->email = $row['email'];
            return true;

            
            
        }

        function isAlreadyExist(){
            //create query
            $query = 'SELECT * FROM '.$this->table.'
            WHERE
                email = ? LIMIT 0,1
            ';

            //prepare the statement
            $stmt = $this->conn->prepare($query);

            //Bind email
            $stmt->bindParam(1,$this->email);

            //execute query
            $stmt->execute();

            if($stmt->rowCount()>0){
                return true;
            }else {
                return false;
            }
        }


    }



?>