<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Team.php';

    //Instance of db & connect
    $database = new Database();
    $db = $database->connect();

    //Instance of team object
    $team = new Team($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $team->name = $data->name;
    $team->createdBy = $data->createdBy;

    //Create Team
    if($team->createTeam()){
        echo json_encode(
            array(
                "status"=>200,
                'message'=>'Team Created'
            )
            );
    }else {
        echo json_encode(
            array(
                'status'=>401,
                'message'=>'Team not created'
            )
            );
    }







?>