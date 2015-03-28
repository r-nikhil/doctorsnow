<?php

require '.././libs/Slim/Slim.php';
require '.././libs/rb.php';

\Slim\Slim::registerAutoloader();

// set up database connection
R::setup('mysql:host=localhost;dbname=doctornowv1','root','');

//R::freeze(true);

$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL; // why do you need this ?
$app->contentType('application/json');

include "doctor/register.php";
include "docotor/createProfile.php";
include "doctor/login.php";

include "patient/register.php";
include "patient/login.php";

include "search/category.php"
include "search/city.php"
// include "search/name.php"

$app->run();

?>
