<?php
$app->post('/doctor/updateProfile', function() use ($app) {

  try {
    //getting json and decoding it
    //$request = $app->request();
    //$body = $request->getBody();
    //$input = json_decode($body);
if ( isset($_SESSION['session_doctor'])){
    $article = R::findOne('doctorsprofile', 'id=?', array($app->request->post('id')));
    // storing to DB


    if ($article) { // if found, return JSON response


      $article->docspecial = $app->request->post('speciality');
      $article->docaddress = $app->request->post('address');
      $article->docpincode = $app->request->post('pincode');
      $article->doccharges = $app->request->post('charges');
      $article->docdegrees = $app->request->post('degrees');
      $article->doccollege = $app->request->post('college');
      $article->docexp = $app->request->post('experience');
      $article->docexpyears = $app->request->post('numofYears');
      $article->docwriteup = $app->request->post('writeup');
      $article->doccity = $app->request->post('city');
      $article->docmember = $app->request->post('memberships');
      $article->doctime = $app->request->post('docTime');
      $article->docclinic = $app->request->post('clinicName');
      $id = R::store($article);

   /*   //making and storing doc time table here
      $time = $app->request->post('docTime');
      $time_arr=explode(',',$time);

      //we need like this date time patient case meds busy confirmed


      $begin = new DateTime( '2010-05-01' );
      $end = new DateTime( '2010-05-10' );

      $interval = DateInterval::createFromDateString('1 day');
      $period = new DatePeriod($begin, $interval, $end);

      foreach ( $period as $dt )
      { echo $dt->format( "l Y-m-d H:i:s\n" );

        foreach ($time_arr as $item) {
          $article = R::dispense('doctime_'.$app->request->post('id'));
        

        
        }

      }
	  */

      $arr=array('status' => '201', 'message' => 'saved');
      $app->response()->header('Content-Type', 'application/json');
      $msg=json_encode($arr );
      $app->response->body($msg );


    }

    else {

      $arr=array('status' => '404', 'message' => 'IdNotFound');
      $app->response()->header('Content-Type', 'application/json');
      $msg=json_encode($arr );
      $app->response->body($msg );


    }
} else {
	$arr=array('status' => '401', 'message' => 'Unauthorized');
    $app->response()->header('Content-Type', 'application/json');
    $msg=json_encode($arr );
    $app->response->body($msg );

  R::close();
}



  }
  catch (Exception $e) {
    $arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
    $app->response()->header('Content-Type', 'application/json');
    $msg=json_encode($arr );
    $app->response->body($msg );

  }


});

?>
