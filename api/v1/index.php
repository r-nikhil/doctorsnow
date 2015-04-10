<?php
session_cache_limiter(false);
//session_start();


session_start();
require '.././libs/Slim/Slim.php';
require '.././libs/rb.php';
\Slim\Slim::registerAutoloader();
// set up database connection
R::setup('mysql:host=localhost;dbname=doctornowv1','root','');
//R::freeze(true);
$app = new \Slim\Slim();
// User id from db - Global Variable
$user_id = NULL; // why do you need this ?

//$app->contentType('application/json');
//$app->response->headers->set('Access-Control-Allow-Origin', '*');
//TODO: make a config file for dev, staging and production
//FOR handling CORS
// Access-Control headers are received during OPTIONS requests
header("Access-Control-Allow-Origin: *");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
	header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}
// instead of mapping:
// $app->options('/(:x+)', function() use ($app) {
// 	//...return correct headers...
// 	//$app->response->setStatus(200);
// 	//$this->next->call();
// });
//Handling CORS ends
// I commented it out because it doesnt make any sense to me.
include "doctor/login.php";
include "doctor/register.php";
include "doctor/createProfile.php";


include "patient/register.php";
include "patient/login.php";
include "patient/utils.php";
include "patient/appointment.php";

include "search/category.php";
include "search/city.php";
// include "search/name.php"


$app->get('/test', function() use ($app) {
	echo "working";
});

$app->run();

?>
