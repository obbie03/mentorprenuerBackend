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

function getCohort($cid){
    global $f;
    try{
        $data = $f->SelectJoins("select * from cohorts where cid = '$cid'")->fetchAll();
            $f->outPut("Successful", 200, $data);
    }
    catch(Exception  $e){
        $f->outPut($e->getMessage(), $e->getCode(), []);
    }
}

function getAnswers($cid, $di, $uid){
    global $f;
    try{
        $data = $f->SelectJoins("select * from answers where cid = '$cid' and uid = '$uid' and qid != 0")->fetchAll();
            $f->outPut("Successful", 200, $data);
    }
    catch(Exception  $e){
        $f->outPut($e->getMessage(), $e->getCode(), []);
    }
}


function approveUser($data){
    global $f;

    try{
        $action = $data['action'];
        $cid = $data['cohortId'];
        $uid = $data['user'];
        $f->runQuery("update usercohort set state = '$action' where cid = '$cid' and uid = '$uid'");
        $f->outPut("Successful", 200, []);
    } catch(Exception  $e){
        $f->outPut($e->getMessage(), $e->getCode(), []);
    }


}

function getCohortUsers($cid){
    global $f;
    try{
        $data = $f->SelectJoins("select * from usercohort uc left join users u on uc.uid = u.userId where cid = '$cid'")->fetchAll();
            $f->outPut("Successful", 200, $data);
    }
    catch(Exception  $e){
        $f->outPut($e->getMessage(), $e->getCode(), []);
    }
}




function addQuestions($data){
    global $f;
    try{
        foreach($data['questions'] as $quest){
            $quest = [
                "cid"=>$data['cid'],
                "qid"=>$quest,
            ];
            $f->insertData($quest, 'cohortquestions');
          }
    
          foreach($data['other'] as $ot){
            $f->insertData([
                "cid"=>$data['cid'],
                "type"=>$ot['type'],
                "valuez"=>implode("|", $ot['arr'])
              ], 'possibleoptions');
          }
            $f->outPut("Successful", 200, $data);
    }
    catch(Exception  $e){
        $f->outPut($e->getMessage(), $e->getCode(), []);
    }
}


function getQuestions($id, $ci, $uid){
    // echo $id;
    // echo $uid;
    
    global $f;
    try{
        $cohort = $f->SelectJoins("select * from cohorts where id = '$id'")->fetchAll();
        $user = $f->SelectJoins("select * from usercohort where cid = '$id' and uid = '$uid'")->fetchAll();
        $questions = $f->SelectJoins("select * from cohortquestions where cid = '$id'")->fetchAll();
        $options = $f->SelectJoins("select * from possibleoptions where cid = '$id'")->fetchAll();
        $data = [
            "cohort"=>$cohort,
            "questions"=>$questions,
            "options"=>$options,
            "user"=>$user
        ];
        $f->outPut("Successful", 200, $data);
    }
    catch(Exception  $e){
        $f->outPut($e->getMessage(), $e->getCode(), []);
    }
}

function postAnswers($data){
    global $f;

    $quest = $data['data'];

    try{
        foreach ($quest as $key => $value) {
            if($key != 'terms&conditions'){
                if (is_array($value)) {
                    $value = implode("|", $value);
                } 
                $d = [
                    "cid"=>$data['cid'],
                    "uid"=>$data['uid'],
                    "qid"=>$key,
                    "response"=>$value,
                ];
                $f->insertData($d, 'answers');
            }
        }

        $f->insertData([
            "cid"=>$data['cid'],
            "uid"=>$data['uid'],
        ], 'usercohort');

        $f->outPut("Successful", 200, $data);
    }
    catch(Exception  $e){
        $f->outPut($e->getMessage(), $e->getCode(), []);
    }

}

