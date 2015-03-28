<?php

$app->post('/doctor/makeAppoitment', function() use ($app) {


  try {
    if ( isset($_SESSION['session_patient'])){
    //getting json and decoding it
    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body);
// i am adduming you will be giving me doctorid and patientid
    // storing to DB
    $article = R::dispense('appointments');
    $article->docId = (string)$input->doctorId;
    $article->patId = (string)$input->patientId;

    $id = R::store($article);

    //$app->response()->header('Content-Type', 'application/json');
    //$app->response()->set->contentType('application/json');

    $arr=array('status' => 'true', 'message' => 'Registered');
    $app->response()->header('Content-Type', 'application/javascript');
    $msg=json_encode($arr );
    $app->response->body($msg );

  }else {
    R::close();
  }

}
  catch (Exception $e) {
    $arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
    $app->response()->header('Content-Type', 'application/javascript');
    $msg=json_encode($arr );
    $app->response->body($msg );

  }
});

$app->post('/doctor/deleteAppoitment/:id', function($id) use ($app) {


  try {
    if ( isset($_SESSION['session_patient'])){
      //getting json and decoding it
      $request = $app->request();
      $body = $request->getBody();
      $input = json_decode($body);
      // i am adduming you will be giving me doctorid and patientid
      // storing to DB
      $article = R::findOne('appointments', 'id=?', array((string)$id));

      R::trash( $article ); //for one bean


      //$app->response()->header('Content-Type', 'application/json');
      //$app->response()->set->contentType('application/json');

      $arr=array('status' => 'true', 'message' => 'appointment deleted');
      $app->response()->header('Content-Type', 'application/javascript');
      $msg=json_encode($arr );
      $app->response->body($msg );

    }else {
      R::close();
    }

  }
  catch (Exception $e) {
    $arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
    $app->response()->header('Content-Type', 'application/javascript');
    $msg=json_encode($arr );
    $app->response->body($msg );

  }
});











?>
