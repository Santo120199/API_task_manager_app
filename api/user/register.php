<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methos: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');


    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    //Instance of db & connect
    $database = new Database();
    $db = $database->connect();

    //Instance of user object
    $user = new User($db);
    
    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $user->username = $data->username;
    $user->email = $data->email;
    $user->password = md5($data->password);

    //Register User
    if($user->register()){
        echo json_encode(
            array(
                'status'=>200,
                'message'=>'User Register')
        );
    }else {
        echo json_encode(
            array(
                'status'=>401,
                'message'=>'User is already registered with this email!!!')
        );
    }



?>