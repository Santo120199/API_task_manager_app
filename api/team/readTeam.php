<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Team.php';

    //Instance of db & connect
    $database = new Database();
    $db = $database->connect();

    //Instance of Team Object
    $team = new Team($db);

    //get data posted
    $data = json_decode(file_get_contents("php://input"));

    $team->createdBy = $data->createdBy;

    //team query
    $result = $team->readTeam();

    //get row count 
    $num = $result->rowCount();

    //check if any team
    if($num >0){
        //team array
        $team_arr = array();
        $team_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $team_item = array(
                'id' => $id,
                'name' => $name,
                'createdBy' => $createdBy,
                'users'=> $users
            );
            //push to "data"
            array_push($team_arr['data'],$team_item);
        }
        echo json_encode($team_arr);

    }else {
        //No team
        echo json_encode(
            array(
                'message' => 'No team found'
            )
            );
    }





?>