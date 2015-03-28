<?php
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

    // we are also storing those fields in docs profile

    $article = R::dispense('doctorsprofile');
    $article->docFname = (string)$input->firstname;
    $article->docLname = (string)$input->lastname;
    $article->doctor_name = (string)$input->firstname." ".(string)$input->lastname  ; // this column is for search
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
?>
