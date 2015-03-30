<?php
$app->post('/doctor/updateProfile', function() use ($app) {

	try {
		//getting json and decoding it
		$request = $app->request();
		$body = $request->getBody();
		$input = json_decode($body);
		if ( isset($_SESSION['session_doctor']) || 1){
			$article = R::findOne('doctorsprofile', 'id=?', array($app->request->post('id')));
			// storing to DB
			if ($article) { // if found, return JSON response
				$article->docspecial = (string)$input->speciality;
				$article->docaddress = (string)$input->address;
				$article->docpincode = (string)$input->pincode;
				$article->doccharges = (string)$input->charges;
				$article->docdegrees = (string)$input->degrees;
				$article->doccollege = (string)$input->college;
				$article->docexp = (string)$input->experience;
				$article->docexpyears = (string)$input->numofYears;
				$article->docwriteup = (string)$input->writeup;
				$article->doccity = (string)$input->city;
				$article->docmember = (string)$input->memberships;
				$article->doctime = (string)$input->docTime;
				$article->docclinic = (string)$input->clinicName;
				$article->docclinicadd = (string)$input->clinicAddress;
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
		}}*/

				$arr=array('status' => $app->response->getStatus(), 'message' => 'saved');
				$app->response()->header('Content-Type', 'application/json');
				$msg=json_encode($arr );
				$app->response->body($msg );
			}
			else {
				$arr=array('status' => $app->response->getStatus(), 'message' => 'IdNotFound');
				$app->response()->header('Content-Type', 'application/json');
				$msg=json_encode($arr );
				$app->response->body($msg );
			}
		} else {
			$arr=array('status' => $app->response->getStatus(), 'message' => 'Unauthorized');
			$app->response()->header('Content-Type', 'application/json');
			$msg=json_encode($arr );
			$app->response->body($msg );
			R::close();
		}
	}
	catch (Exception $e) {
		$arr=array('status' => $app->response->getStatus(), 'message' => ' '. $e->getMessage().' ');
		$app->response()->header('Content-Type', 'application/json');
		$msg=json_encode($arr );
		$app->response->body($msg );
	}
});

?>
