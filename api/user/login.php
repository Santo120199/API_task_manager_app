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

    //Instance of task object
    $user = new User($db);

    //data
    $data = json_decode(file_get_contents("php://input"));

    //Get raw posted data
    $user->email = $data->email;
    $user->password = md5($data->password);

    $result = $user->login();

    if($result){
        $user_arr = array(
            'id'=>$user->id,
            'username'=>$user->username,
            'email'=>$user->email,
        );
        print_r(json_encode($user_arr));
    }else {
        echo json_encode(
            array(
                'status'=>401,
                'message'=>'Invalid Credentials'
            )
        );
    }

   

    

    
    


    




?>