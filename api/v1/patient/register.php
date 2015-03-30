<?php

$app->post('/patient/register', function() use ($app) {
  try {
    //getting json and decoding it
    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);

    // storing to DB
    $article = R::dispense('patientregister');
<<<<<<< HEAD
    $article->patfname = $app->request->post('firstName');
    $article->patlname = $app->request->post('lastName');
    $article->patmobile = $app->request->post('mobile');
    $article->patemail = $app->request->post('email');
    $article->patpassword = $app->request->post('password');
    $article->docname = $app->request->post('firstName')." ".$app->request->post('lastName');  // this column is for search
=======
    $article->patfname = (string)$input->firstname;
    $article->patlname = (string)$input->lastname;
    $article->patmobile = (string)$input->mobile;
    $article->patemail = (string)$input->email;
    $article->patpassword = (string)$input->password;
    $article->patientname = (string)$input->firstname." ".(string)$input->lastname  ;
>>>>>>> parent of e094738... Why Why ?
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
