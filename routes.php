<?php

$routes = [
    'GET' => [
    '/users' => 'getUsers',
    '/user/{userId}' => 'getUser',
    '/cohorts/{cid}' => 'getCohort',
    '/settings' => 'getSettings',
 
    ],
    'POST' => [
        '/users' => 'addUser',
        '/login' => 'login',  
        '/addCohort' => 'addCohort',  
        '/settings' => 'addSetting',  
        
    ],
];