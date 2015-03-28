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
 
 
 $app->post('/doctor/register', function() use ($app) {
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
			
			//Nikhil note this storage when we are registering, we are also storing those fields in docs profile
			
			$article = R::dispense('doctorsprofile');
			$article->docFname = (string)$input->firstname;
			$article->docLname = (string)$input->lastname;
			$article->doctor_name = (string)$input->firstname." ".(string)$input->lastname  ;
			$article->docMobile = (string)$input->mobile;
			$article->docEmail = (string)$input->email;
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
		

 $app->post('/doctors/createProfile', function() use ($app) {
		try {	
			//getting json and decoding it
			$request = $app->request();
			$body = $request->getBody();
			$input = json_decode($body); 
		
		
		
			$article = R::findOne('doctorsprofile', 'id=?', array((string)$input->doc_id));
			// storing to DB
			
			
			if ($article) { // if found, return JSON response
			  
			
				$article->docspecial = (string)$input->speciality;
				$article->docadd = (string)$input->address;
				$article->docpin = (string)$input->pincode;
				$article->doccharges = (string)$input->charges;
				$article->docdegrees = (string)$input->degrees;
				$article->doccollege = (string)$input->college;
				$article->docexp = (string)$input->experience;
				$article->docwriteup = (string)$input->writeup;
				$article->doccity = (string)$input->city;
				$article->docmember = (string)$input->memberships;
				$article->doctime = (string)$input->doc_time;
				$article->docclinic = (string)$input->clinicname;
				$id = R::store($article); 
			  
				//making and storing doc time table here
				$time = (string)$input->doc_time;
				$time_arr=explode(',',$time);
				
				//we need like this date time patient case meds busy confirmed
				
				
				$begin = new DateTime( '2010-05-01' );
				$end = new DateTime( '2010-05-10' );

				$interval = DateInterval::createFromDateString('1 day');
				$period = new DatePeriod($begin, $interval, $end);

				foreach ( $period as $dt )
				 { echo $dt->format( "l Y-m-d H:i:s\n" );
				
		       	foreach ($time_arr as $item) {
					  $article = R::dispense('doctime_'.(string)$input->doc_id);
					  $article->docspecial = (string)$input->speciality;
					  $article->docadd = (string)$input->address;
					  $article->docpin = (string)$input->pincode;
					  $article->doccharges = (string)$input->charges;
					  
					  echo "$item\n";
         		}
				
				}
				
				
				
					$arr=array('status' => 'true', 'message' => 'saved');
					 $app->response()->header('Content-Type', 'application/javascript');
					 $msg=json_encode($arr );
					 $app->response->body($msg );
					
					
				 
				
            
			} 
			
			else {
			
			 $arr=array('status' => 'true', 'message' => 'This email seems to be not registered. Any typo? ');
			 $app->response()->header('Content-Type', 'application/javascript');
			 $msg=json_encode($arr );
			 $app->response->body($msg );
				
					
			}
		 } 
		catch (Exception $e) {
			$arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
			$app->response()->header('Content-Type', 'application/javascript');
			$msg=json_encode($arr );
			$app->response->body($msg );
			
		  }	
			
           
        });
		

		
 $app->post('/patient/register', function() use ($app) {
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
		

 $app->post('/patient/login', function() use ($app) {
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
					$arr=array('status' => 'true', 'message' => 'logging in','patient_id' => $article->id);
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
 

 $app->post('/doctor/login', function() use ($app) {
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
					$arr=array('status' => 'true', 'message' => 'logging in', 'doc_id' => $article->id );
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