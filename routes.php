<?php

$routes = [
    'GET' => [
    '/users' => 'getUsers',
    '/user/{userId}' => 'getUser',
    '/cohorts/{cid}' => 'getCohort',
    '/settings' => 'getSettings',
    '/getQuestions/{cid}/{uid}' => 'getQuestions',
    '/getCohortUsers/{cid}' => 'getCohortUsers',
    '/getAnswers/{cid}/{uid}' => 'getAnswers',
    '/getBioData/{cid}' => 'getBioData',

    ],
    'POST' => [
        '/users' => 'addUser',
        '/login' => 'login',  
        '/addCohort' => 'addCohort',  
        '/settings' => 'addSetting',  
        '/cohortQuestions' => 'addQuestions',  
        '/answers'=>'postAnswers',
        '/approveUser'=>'approveUser',
    ],
];