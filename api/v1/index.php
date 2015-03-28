<?php

require '.././libs/Slim/Slim.php';
require '.././libs/rb.php';

\Slim\Slim::registerAutoloader();

// set up database connection
R::setup('mysql:host=localhost;dbname=doctornowv1','root','');

//R::freeze(true);


$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL;
$app->contentType('application/json');


include "doctor/register.php";
include "docotor/createProfile.php";
include "patient/register.php";
include "patient/login.php";



$app->get('/doctor/category/:type_id', function($type_id) use ($app) {
	try {
			//getting json and decoding it
			$request = $app->request();
			$body = $request->getBody();
			$input = json_decode($body);

			$article = R::find('doctorsprofile', 'type_id=?', array($type_id));

			if ($article){
					// return JSON-encoded response body with query results
					$var_result=R::exportAll($article);
					$arr=array('status' => 'true', 'message' => 'found','query_result'=> $var_result );
					 $app->response()->header('Content-Type', 'application/javascript');

					 $msg=json_encode($arr);
					 $app->response->body($msg );
				  }
				else
				{
					 $arr=array('status' => 'true', 'message' => 'no results');
					 $app->response()->header('Content-Type', 'application/javascript');
					 $msg=json_encode($arr );
					 $app->response->body($msg );

				}




		 } catch (Exception $e) {
			$arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
			$app->response()->header('Content-Type', 'application/javascript');
			$msg=json_encode($arr );
			$app->response->body($msg );
		  }



});

$app->get('/doctors/search/city/:city_name', function($city_name) use ($app) {
	try {
			//getting json and decoding it
			$request = $app->request();
			$body = $request->getBody();
			$input = json_decode($body);

			$article = R::findOne('doctorsprofile', 'doccity=?', array($city_name));

			if ($article){
					// return JSON-encoded response body with query results
					$var_result=R::exportAll($article);
					$arr=array('status' => 'true', 'message' => 'found','query_result'=> $var_result );
					 $app->response()->header('Content-Type', 'application/javascript');

					 $msg=json_encode($arr);
					 $app->response->body($msg );
				  }
				else
				{
					 $arr=array('status' => 'true', 'message' => 'no results');
					 $app->response()->header('Content-Type', 'application/javascript');
					 $msg=json_encode($arr );
					 $app->response->body($msg );

				}




		 } catch (Exception $e) {
			$arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
			$app->response()->header('Content-Type', 'application/javascript');
			$msg=json_encode($arr );
			$app->response->body($msg );
		  }


});

$app->get('/doctor/category/:type_id', function($type_id) use ($app) {
  try {
    //getting json and decoding it
    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);

    $article = R::find('doctorsprofile', 'type_id=?', array($type_id));

    if ($article){
      // return JSON-encoded response body with query results
      $var_result=R::exportAll($article);
      $arr=array('status' => 'true', 'message' => 'found','query_result'=> $var_result );
      $app->response()->header('Content-Type', 'application/javascript');

      $msg=json_encode($arr);
      $app->response->body($msg );
    }
    else
    {
      $arr=array('status' => 'true', 'message' => 'no results');
      $app->response()->header('Content-Type', 'application/javascript');
      $msg=json_encode($arr );
      $app->response->body($msg );

    }




  } catch (Exception $e) {
    $arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
    $app->response()->header('Content-Type', 'application/javascript');
    $msg=json_encode($arr );
    $app->response->body($msg );
  }


});


$app->get('/doctors/search/name/:name', function($name) use ($app) {
  try {
    //getting json and decoding it
    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);
// use regex here
    // $article = R::findOne('doctorsprofile', 'd=?', array($name));

    if ($article){
      // return JSON-encoded response body with query results
      $var_result=R::exportAll($article);
      $arr=array('status' => 'true', 'message' => 'found','query_result'=> $var_result );
      $app->response()->header('Content-Type', 'application/javascript');

      $msg=json_encode($arr);
      $app->response->body($msg );
    }
    else
    {
      $arr=array('status' => 'true', 'message' => 'no results');
      $app->response()->header('Content-Type', 'application/javascript');
      $msg=json_encode($arr );
      $app->response->body($msg );

    }




  } catch (Exception $e) {
    $arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
    $app->response()->header('Content-Type', 'application/javascript');
    $msg=json_encode($arr );
    $app->response->body($msg );
  }


});





















// a route /doctors/getschedule/:date1/:date2/:option
//this should give me all rows between date1 and date2 of docs shcedule, which will be in dd-mm format
//option will act as a filter
// by default option will be 0 that is return all rows
// option -1 means return all rows when he is free
//option +1 means return all rows when is busy or booked


//a route /doctors/makeapp/   this route will make appointment
// this will be a post request with doc_id, date(dd-mm) and time (hh-mm), patient id and two more text fields about him



$app->run();

?>
