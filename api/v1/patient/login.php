<?php


$app->post('/patient/login', function() use ($app) {
  try {
    //getting json and decoding it
    //$request = $app->request();
    //$body = $request->getBody();
    //$input = json_decode($body);

    $article = R::findOne('patientregister', 'patemail=?', array($app->request->post('email')));

    if ($article) { // if found, return JSON response
      $pass_db = (string)$article->patpassword;
      $pass_request = $app->request->post('password');
      if($pass_db === $pass_request)
      {
        $arr=array('status' => '201', 'message' => 'loggingIn', 'patId' => $article->id ); // store the id in front
        $app->response()->header('Content-Type', 'application/javascript');
        $msg=json_encode($arr );
        $app->response->body($msg );
        $session = $article->patemail;
        $session .= $article->patlname; // i concatenated email and last name and stored it in the session variable.
        $_SESSION['session_patient'] = $session;
        $_SESSION['patId'] = $article->id;
        $_SESSION['patEmail'] = $article->patemail;
        $_SESSION['patLname'] = $article->patlname;

      }
      else
      {
        $arr=array('status' => '401', 'message' => 'wrongPassword');
        $app->response()->header('Content-Type', 'application/javascript');
        $msg=json_encode($arr );
        $app->response->body($msg );
      }
    }
    else {

      $arr=array('status' => '401', 'message' => 'emailNotRegistered');
      $app->response()->header('Content-Type', 'application/javascript');
      $msg=json_encode($arr );
      $app->response->body($msg );


    }
  } catch (ResourceNotFoundException $e) {
    // return 404 server error
    $app->response()->status(404);
  }
  catch (Exception $e) {
    $arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
    $app->response()->header('Content-Type', 'application/javascript');
    $msg=json_encode($arr );
    $app->response->body($msg );
  }


});










?>
