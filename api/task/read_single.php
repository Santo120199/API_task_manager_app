<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Task.php';

    //Instance of db & connect
    $database = new Database();
    $db = $database->connect();

    //Instance of task object
    $task = new Task($db);

    //Get ID
    $task->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get single task
    $task->read_single();

    //create array
    $task_arr = array(
        'id' => $task->id,
        'title' => $task->title,
        'note' => $task->note,
        'isCompleted' => $task->isCompleted,
        'date' => $task->date,
        'startTime' => $task->startTime,
        'endTime' => $task->endTime,
        'remind' => $task->remind,
        'repeat' => $task->repeat,
    );

    //Make JSON
    print_r(json_encode($task_arr));




?>