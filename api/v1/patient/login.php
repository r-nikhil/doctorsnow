<?php
$app->post('/patient/login', function() use ($app) {
	try {
		//getting json and decoding it
		$article = R::findOne('patientregister', 'patEmail=?', array($app->request->post('email')));

		if ($article) { // if found, return JSON response
			$pass_db = (string)$article->patpassword;
			$pass_request = (string)$input->password;
			$pass_request = $app->request->post('password');
			if($pass_db === $pass_request)
			{
				$arr=array('status' => '200', 'message' => 'logged in','patientId' => $article->id, 'patientName' => $article->patfname); // store the id in front
				$app->response()->header('Content-Type', 'application/json');
				$msg=json_encode($arr );
				$app->response->body($msg );
				$_SESSION['patEmail'] = $article->patemail;
				$_SESSION['patId'] = $article->id;
				$_SESSION['patName'] = $article->patlname; // patient name because we will be sending it to frontend if they want to use
				$_SESSION['session_patient'] = $article->patemail.$article->patlname; // patient name because we will be sending it to frontend if they want to use
				

			}
			else
			{
				$arr=array('status' => '200', 'message' => 'wrongPassword');
				$app->response()->header('Content-Type', 'application/json');
				$msg=json_encode($arr );
				$app->response->body($msg );


			}

		}

		else {

			$arr=array('status' => '200', 'message' => 'emailNotRegistered');
			$app->response()->header('Content-Type', 'application/json');
			$msg=json_encode($arr );
			$app->response->body($msg );


		}
	} catch (ResourceNotFoundException $e) {
		// return 404 server error
		$app->response()->status(404);
	}
	catch (Exception $e) {
		$arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
		$app->response()->header('Content-Type', 'application/json');
		$msg=json_encode($arr );
		$app->response->body($msg );
	}


});
?>
