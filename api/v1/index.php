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
 
 
 $app->post('/register_doctor', function() use ($app) {
		try {	
			//getting json and decoding it
			$request = $app->request();
			$body = $request->getBody();
			$input = json_decode($body); 
		
		// storing to DB
			$article = R::dispense('doctorregister');
			$article->docFname = (string)$input->firstname;
			$article->docLname = (string)$input->lastname;
			$article->docMobile = (string)$input->mobile;
			$article->docEmail = (string)$input->email;
			$article->docPassword = (string)$input->password;
			$id = R::store($article); 
			
			//$app->response()->header('Content-Type', 'application/json');
			//$app->response()->set->contentType('application/json');
					
			 $arr=array('status' => 'true', 'message' => 'Registered');
			 $app->response()->header('Content-Type', 'application/javascript');
			 $msg=json_encode($arr );
			 $app->response->body($msg );
		
			}
			
		catch (Exception $e) {
			$arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
			$app->response()->header('Content-Type', 'application/javascript');
			$msg=json_encode($arr );
			$app->response->body($msg );
			
		  }	
			
           
        });
		
		
 $app->post('/register_patient', function() use ($app) {
		try {	
			//getting json and decoding it
			$request = $app->request();
			$body = $request->getBody();
			$input = json_decode($body); 
		
		// storing to DB
			$article = R::dispense('patientregister');
			$article->docFname = (string)$input->firstname;
			$article->docLname = (string)$input->lastname;
			$article->docMobile = (string)$input->mobile;
			$article->docEmail = (string)$input->email;
			$article->docPassword = (string)$input->password;
			$id = R::store($article); 
			
			//$app->response()->header('Content-Type', 'application/json');
			//$app->response()->set->contentType('application/json');
					
			 $arr=array('status' => 'true', 'message' => 'Registered');
			 $app->response()->header('Content-Type', 'application/javascript');
			 $msg=json_encode($arr );
			 $app->response->body($msg );
		
			}
			
		catch (Exception $e) {
			$arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
			$app->response()->header('Content-Type', 'application/javascript');
			$msg=json_encode($arr );
			$app->response->body($msg );
			
		  }	
			
           
        });		
		

 $app->post('/login_patient', function() use ($app) {
		try {	
			//getting json and decoding it
			$request = $app->request();
			$body = $request->getBody();
			$input = json_decode($body); 
		
			$article = R::findOne('patientregister', 'doc_email=?', array((string)$input->username));
			
			if ($article) { // if found, return JSON response
			    $pass_db = (string)$article->doc_password;
			    $pass_request = (string)$input->password;
				if($pass_db == $pass_request)
				{   
					$arr=array('status' => 'true', 'message' => 'logging in');
					 $app->response()->header('Content-Type', 'application/javascript');
					 $msg=json_encode($arr );
					 $app->response->body($msg );
					
					
				  }
				else
				{ 	
					 $arr=array('status' => 'true', 'message' => 'wrong password');
					 $app->response()->header('Content-Type', 'application/javascript');
					 $msg=json_encode($arr );
					 $app->response->body($msg );
			
					
				}	
            
			} 
			
			else {
			
			 $arr=array('status' => 'true', 'message' => 'This email seems to be not registered. Any typo? ');
			 $app->response()->header('Content-Type', 'application/javascript');
			 $msg=json_encode($arr );
			 $app->response->body($msg );
				
					
			}
		 } catch (ResourceNotFoundException $e) {
			// return 404 server error
			$app->response()->status(404);
		  } catch (Exception $e) {
			$arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
			$app->response()->header('Content-Type', 'application/javascript');
			$msg=json_encode($arr );
			$app->response->body($msg );
		  }
			
           
        });		
 

 $app->post('/login_doctor', function() use ($app) {
		try {	
			//getting json and decoding it
			$request = $app->request();
			$body = $request->getBody();
			$input = json_decode($body); 
		
			$article = R::findOne('doctorregister', 'doc_email=?', array((string)$input->username));
			
			if ($article) { // if found, return JSON response
			    $pass_db = (string)$article->doc_password;
			    $pass_request = (string)$input->password;
				if($pass_db == $pass_request)
				{   
					$arr=array('status' => 'true', 'message' => 'logging in');
					 $app->response()->header('Content-Type', 'application/javascript');
					 $msg=json_encode($arr );
					 $app->response->body($msg );
					
					
				  }
				else
				{ 	
					 $arr=array('status' => 'true', 'message' => 'wrong password');
					 $app->response()->header('Content-Type', 'application/javascript');
					 $msg=json_encode($arr );
					 $app->response->body($msg );
			
					
				}	
            
			} 
			
			else {
			
			 $arr=array('status' => 'true', 'message' => 'This email seems to be not registered. Any typo? ');
			 $app->response()->header('Content-Type', 'application/javascript');
			 $msg=json_encode($arr );
			 $app->response->body($msg );
				
					
			}
		 } catch (ResourceNotFoundException $e) {
			// return 404 server error
			$app->response()->status(404);
		  } catch (Exception $e) {
			$arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
			$app->response()->header('Content-Type', 'application/javascript');
			$msg=json_encode($arr );
			$app->response->body($msg );
		  }
			
           
        });	


$app->get('/getdoctors/:type_id', function($type_id) use ($app) {
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

$app->get('/doctors/:id', function($id) use ($app) {
	try {	
			//getting json and decoding it
			$request = $app->request();
			$body = $request->getBody();
			$input = json_decode($body); 
	
			$article = R::findOne('doctorsprofile', 'id=?', array($id));
			
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




// a route /doctors/getschedule/:day1/:day2/:option
//this should give me all rows between day1 and day2 of docs shcedule
//option will act as a filter
// by default option will be 0 that is return all rows
// option -1 means return all rows when he is free
//option +1 means return all rows when is busy or booked
		

$app->run();

?>