<?php

function addCohort($data){
    global $f;
    try{
        $check = $f->insertData($data, 'cohorts');
        if($check){
            $f->outPut("Successful", 200, $data);
        }else{
            $f->outPut("Something went wrong", 500, []);
        }
    }
    catch(Exception  $e){
        $f->outPut($e->getMessage(), $e->getCode(), []);
    }
}


function getCohort($id){

    global $f;

    try{
        $data = $f->SelectJoins("select * from cohorts where cid = '$id'")->fetchAll();
            $f->outPut("Successful", 200, $data);
       
    }
    catch(Exception  $e){
        $f->outPut($e->getMessage(), $e->getCode(), []);
    }

}