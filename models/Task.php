<?php

    class Task {
        private $conn;
        private $table = 'tasks';

        //task properties
        public $id;
        public $title;
        public $note;
        public $isCompleted;
        public $date;
        public $startTime;
        public $endTime;
        public $remind;
        public $userId;
        public $color;


        //constructor with db
        public function __construct($db){
            $this->conn = $db;
        }

        //Get Tasks
        public function read(){
            //Create query
            $query = 'SELECT * FROM '.$this->table.'
            WHERE 
                userId = ? 
            ';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            //Bind userId
            $stmt->bindParam(1,$this->userId);

            //execute query
            $stmt->execute();

            return $stmt;
        }

        //Get Single Task
        public function read_single(){
            //Create query
            $query = 'SELECT * FROM '.$this->table.' WHERE id = ? LIMIT 0,1';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            //Bind ID
            $stmt->bindParam(1,$this->id);

            //execute query
            $stmt->execute();

            //fetc
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set property
            $this->title = $row['title'];
            $this->note = $row['note'];
            $this->isCompleted = $row['isCompleted'];
            $this->date = $row['date'];
            $this->startTime = $row['startTime'];
            $this->endTime = $row['endTime'];
            $this->remind = $row['remind'];
            
        }


        //Create Task
        public function create()
        {
            //Create query
            $query = 'INSERT INTO '. $this->table.'
            SET
                title = :title,
                note = :note,
                isCompleted = :isCompleted,
                date = :date,
                startTime = :startTime,
                endTime = :endTime,
                remind = :remind,
                userId = :userId,
                color = :color
            ';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->note = htmlspecialchars(strip_tags($this->note));
            $this->isCompleted = htmlspecialchars(strip_tags($this->isCompleted));
            $this->date = htmlspecialchars(strip_tags($this->date));
            $this->startTime = htmlspecialchars(strip_tags($this->startTime));
            $this->endTime = htmlspecialchars(strip_tags($this->endTime));
            $this->remind = htmlspecialchars(strip_tags($this->remind));
            $this->userId = htmlspecialchars(strip_tags($this->userId));
            $this->color = htmlspecialchars(strip_tags($this->color));


            //Bind param
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':note', $this->note);
            $stmt->bindParam(':isCompleted', $this->isCompleted);
            $stmt->bindParam(':date', $this->date);
            $stmt->bindParam(':startTime', $this->startTime);
            $stmt->bindParam(':endTime', $this->endTime);
            $stmt->bindParam(':remind', $this->remind);
            $stmt->bindParam(':userId',$this->userId);
            $stmt->bindParam(':color',$this->color);


            //execute query
            if ($stmt->execute()) {
                return true;
            }

            //print error
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        //Delete task
        public function delete(){
            //create query
            $query = 'DELETE FROM '.$this->table. ' WHERE id = :id ';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //bind data
            $stmt->bindParam(':id',$this->id);

            //execute query
            if($stmt->execute()){
                return true;
            }
            printf("Error: %s.\n",$stmt->error);

            return false;
        }

        //update task
        public function complete()
        {
            //Create query
            $query = 'UPDATE '. $this->table.'
            SET
                isCompleted = :isCompleted
            WHERE 
                id = :id
            ';

            //prepare statment
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->isCompleted = htmlspecialchars(strip_tags($this->isCompleted));
            $this->id = htmlspecialchars(strip_tags($this->id));
          


            //Bind param
            $stmt->bindParam(':isCompleted', $this->isCompleted);
            $stmt->bindParam(':id',$this->id);
          

            //execute query
            if ($stmt->execute()) {
                return true;
            }

            //print error
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
        

}

?>