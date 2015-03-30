<?php
$app->post('/patient/register', function() use ($app) {
  try {
    //getting json and decoding it
    // $request = $app->request();
    // $body = $request->getBody();
    // $input = json_decode($body);

    // storing to DB
    $article = R::dispense('patientregister');
    $article->patfname = $app->request->post('firstName');
    $article->patlname = $app->request->post('lastName');
    $article->patmobile = $app->request->post('mobile');
    $article->patemail = $app->request->post('email');
    $article->patpassword = $app->request->post('password');
    $article->docname = $app->request->post('firstName')." ".$app->request->post('lastName');  ; // this column is for search
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
