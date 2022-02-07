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

    //task query
    $result = $task->read();

    //get row count
    $num = $result->rowCount();

    //check if any task
    if($num > 0){

        //task array
        $task_arr = array();
        $task_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $task_item = array(
                'id' => $id,
                'title' => $title,
                'note' => $note,
                'isCompleted' => $isCompleted,
                'date' => $date,
                'startTime' => $startTime,
                'endTime' => $endTime,
                'remind' => $remind,
            );

            //push to "data"
            array_push($task_arr['data'],$task_item);
        }

        //turn to JSON & output
        echo json_encode($task_arr);
    }else {
        //No task
        echo json_encode(
            array( 'message' => 'No task found')
        );      
    }

?>