<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methos: POST');
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

    $task->title = $data->title;
    $task->note = $data->note;
    $task->isCompleted = $data->isCompleted;
    $task->date = $data->date;
    $task->startTime = $data->startTime;
    $task->endTime = $data->endTime;
    $task->remind = $data->remind;
    $task->userId = $data->userId;
    

    //Create task
    if($task->create()){
        echo json_encode(
            array('message'=>'Task Created')
        );
    }else {
        echo json_encode(
            array('message'=>'Task not Created')
        );
    }



?>    