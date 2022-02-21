<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    //Instance of db & connect
    $database = new Database();
    $db = $database->connect();

    //Instance of task object
    $user = new User($db);

    //get data posted
    $data = json_decode(file_get_contents("php://input"));

    $user->id = $data->id;

    $result = $user->readUser();

    //get row count
    $num = $result->rowCount();

    //check if any user
    if($num > 0){
        //user arr
        $user_arr = array();
        $user_arr['data'] = array();

        while($row= $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $user_item = array(
                'id' => $id,
                'username' => $username,
                'email' => $email
            );

            //push to "data"
            array_push($user_arr['data'],$user_item);
        }
        echo json_encode($user_arr);
    }else {
        //NO user
        echo json_encode(
            array('message'=>'No user found')
        );
    }




?>