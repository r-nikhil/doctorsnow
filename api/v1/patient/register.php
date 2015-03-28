<?php

$app->post('/patient/register', function() use ($app) {
  try {
    //getting json and decoding it
    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);

    // storing to DB
    $article = R::dispense('patientregister');
    $article->patFname = (string)$input->firstname;
    $article->patLname = (string)$input->lastname;
    $article->patMobile = (string)$input->mobile;
    $article->patEmail = (string)$input->email;
    $article->patPassword = (string)$input->password;
    $article->patient_name = (string)$input->firstname." ".(string)$input->lastname  ;
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

?>
