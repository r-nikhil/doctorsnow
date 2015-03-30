<?php

$app->post('/patient/register', function() use ($app) {
  try {
    $article = R::dispense('patientregister');
    $article->patfname = $app->request->post('firstname');
    $article->patlname = $app->request->post('lastname');
    $article->patmobile = $app->request->post('mobile');
    $article->patemail = $app->request->post('email');
    $article->patpassword = $app->request->post('password');
    $article->patientname = $app->request->post('firstname')." ".$app->request->post('lastname'); 
    $id = R::store($article);

    //$app->response()->header('Content-Type', 'application/json');
    //$app->response()->set->contentType('application/json');
	
	 $book = R::load( 'patientregister', $id );
	
    $arr=array('status' => '200', 'message' => 'Registered');
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
