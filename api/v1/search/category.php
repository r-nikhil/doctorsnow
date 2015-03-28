<?php
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
?>
