<?php
require 'db.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$body = $app->request->getBody();
	echo $body;




$app->run();


$app->post('/login_patient', function () use ($app) {
    $body = $app->request->getBody();
	echo $body;
});


?>