<?php

require '.././libs/Slim/Slim.php';
require '.././libs/rb.php';
 
\Slim\Slim::registerAutoloader();

// set up database connection
R::setup('mysql:host=localhost;dbname=doctornow','root','');

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
			$app->response()->set->contentType('application/json');
			$arr=array('status' => 'success', 'message' => 'registered');
			
			echo json_encode($arr);
			
			}
			
		catch (Exception $e) {
			$app->response()->status(400);
			$app->response()->header('X-Status-Reason', $e->getMessage());
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
					//$app->response()->set->contentType('application/json');
					 $app->response->body( json_encode("{'status':'success', 'message' : 'logging in'}" ));
					
					
				  }
				else
				{ 	
					 $arr=array('status' => 'success', 'message' => 'false');
					 $app->response()->header('Content-Type', 'application/javascript');
					 $msg=json_encode($arr );
					 $app->response->body($msg );
			
					
				}	
            
			} 
			
			else {
			
			 $arr=array('status' => 'success', 'message' => 'not registered');
			 $app->response()->header('Content-Type', 'application/javascript');
			 $msg=json_encode($arr );
			 $app->response->body($msg );
				
					
			}
		 } catch (ResourceNotFoundException $e) {
			// return 404 server error
			$app->response()->status(404);
		  } catch (Exception $e) {
			$app->response()->status(400);
			$app->response()->header('X-Status-Reason', $e->getMessage());
		  }
			
           
        });		
 
$app->run();

?>