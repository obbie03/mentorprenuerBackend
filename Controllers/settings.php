<?php

function addLanguage($data){
    global $f;
    try{
        $check = $f->insertData($data, 'languages');
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

function addLocation($data){
    global $f;
    try{
        $check = $f->insertData($data, 'locations');
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

function addSetting($data){
    global $f;
    try{
        $check = $f->insertData($data, 'settings');
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

function getSettings(){
    global $f;
    try{
        $data = $f->selectData('settings', '', '')->fetchAll();        
            $f->outPut("Successful", 200, $data);
    }
    catch(Exception  $e){
        $f->outPut($e->getMessage(), $e->getCode(), []);
    }
}