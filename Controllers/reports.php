<?php

function getBioData($cid){

    global $f;
    try{
        $users = $f->selectJoins("select * from usercohort uc left join users u on uc.uid = u.userId where uc.cid = '$cid'")->fetchAll(PDO::FETCH_OBJ);

        $userIds = array_map(function($user) {
            return $user->userId;
        }, $users);
        $userIdsString = implode(", ", $userIds);
        $otherDetails = $f->selectJoins("select * from answers where uid in ($userIdsString)")->fetchAll();
        $data = [
            "user"=>$users,
            "otherDetails"=>$otherDetails
        ];
        $f->outPut("Successful", 200, $data);
    }
    catch(Exception  $e){
        $f->outPut($e->getMessage(), $e->getCode(), []);
    }

}