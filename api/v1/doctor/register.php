<?php
$app->post('/doctor/register', function() use ($app) {
  try {
    //getting json and decoding it
    //$request = $app->request();
    //$body = $request->getBody();
	//$input = json_decode($body);
	
    // storing to DB
    $article = R::dispense('doctorregister');
    $article->docfname = $app->request->post('firstName');
    $article->doclname = $app->request->post('lastName');
    $article->docmobile = $app->request->post('mobile');
    $article->docemail = $app->request->post('email');
    $article->docpassword = $app->request->post('password');
    $id = R::store($article);

    // we are also storing those fields in docs profile
    $article = R::dispense('doctorsprofile');
	$article->docfname = $app->request->post('firstName');
    $article->doclname = $app->request->post('lastName');
    $article->docmobile = $app->request->post('mobile');
    $article->docemail = $app->request->post('email');
    $article->docpassword = $app->request->post('password');   
    $article->docname = $app->request->post('firstName')." ".$app->request->post('lastName');  ; // this column is for search
   
    $id = R::store($article);

    //$app->response()->header('Content-Type', 'application/json');
    //$app->response()->set->contentType('application/json');

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
