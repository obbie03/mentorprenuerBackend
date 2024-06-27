<?php

function addUser($data){
    global $f;
    try{

    $emailExists = $f->checkColumns($data['email'], 'email', 'authentication');
    

    if ($emailExists) {
        $f->outPut('Email address already exists', 400, []);
        return;
    } 

    $auth = [
        "email"=>$data['email'],
        "userType"=>$data['userType']??1,
        "password"=>password_hash($data['password'], PASSWORD_DEFAULT)
    ];

        $uid = $f->insertReturnId($auth, 'authentication');
        $user = [
            "userId"=>$uid,
            "firstName"=>$data['firstName'],
            "otherName"=>$data['otherName']??'',
            "lastName"=>$data['lastName'],
            "phoneNumber"=>$data['phoneNumber'],
            "dob"=>$data['dateOfBirth'],
            "field"=>$data['fieldOfStudy'],
            "level"=>$data['educationLevel'],
        ];
        $f->insertData($user, 'users');
        $f->outPut("Successful", 200, []);
    }catch(Exception  $e){
        $f->outPut($e->getMessage(), $e->getCode(), []);
    }
}

function getUsers(){
    global $f;
    $f->outPut('Hello', 200, []);
}


function login($data){
    global $f;
    try{
        $email = $data['email'];
        $password = $data['password'];
        $user = $f->selectJoins("SELECT * FROM authentication WHERE email = '$email' LIMIT 1");
        if($user->rowCount() > 0){
            $userObject = $user->fetchObject(); 
            if (password_verify($password, $userObject->password)) {
                $f->outPut("Successful", 200, [$userObject]);
            } else {
                $f->outPut('Wrong password', 405, []);
            }
        }else{
            $f->outPut('Email does not exist', 404, []);
        }
    }catch (Exception  $e){
       $f->outPut($e->getMessage(), 500, []);
    }
}




