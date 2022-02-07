<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methos: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');


    include_once '../../config/Database.php';
    include_once '../../models/Task.php';

    //Instance of db & connect
    $database = new Database();
    $db = $database->connect();

    //Instance of task object
    $task = new Task($db);


    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //set it
    $task->id = $data->id;

    
    $task->isCompleted = $data->isCompleted;

    

    //Create task
    if($task->complete()){
        echo json_encode(
            array('message'=>'Task Completed')
        );
    }else {
        echo json_encode(
            array('message'=>'Task not Completed')
        );
    }



?>    