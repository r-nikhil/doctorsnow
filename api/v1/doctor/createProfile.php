<?php
$app->post('/doctor/updateProfile', function() use ($app) {

	try {
		//getting json and decoding it
		$request = $app->request();
		$body = $request->getBody();
		$input = json_decode($body);
		if ( isset($_SESSION['session_doctor']) || 1){
			$article = R::findOne('doctorsprofile', 'id=?', array((string)$input->id));
			// storing to DB
			if ($article) { // if found, return JSON response
				//$article->docspecial = (string)$input->speciality;
				$article->doccity = (string)$input->city;
				$article->docexpyears = (string)$input->numOfYears;
				$article->docinterests = (string)$input->interests;
				$article->docwriteup = (string)$input->writeup;
				$article->doccharges = (string)$input->charges;
				$article->doclocality = (string)$input->locality;
				$article->docavailability = (string)$input->availablity;
				$article->docservices = (string)$input->services;
				$article->docclinicname = (string)$input->clinicname;
				$article->docclinicaddress = (string)$input->clinicaddress;
				
				$input->experience = explode(":", $input->experience);
				foreach ($input->experience as $exp) 
				{					
				$experience =R::dispense('doctorexperience');
  				$experience->docid = $article->docid;	
				$experience->desc = $exp;
				//$article->docexperience[] = $experience;	
				$id = R::store($experience);
				}	
	
				$input->education = explode(":", $input->education);
				foreach ($input->education as $edu) 
				{
				$education =R::dispense('doctoreducation');
  				$education->docid = $article->docid;	
				$education->desc = $edu;
				//$article->doceducation[] = $education;	
				$id = R::store($education);
				}	
				
				$input->memberships = explode(":", $input->memberships);
				foreach ($input->memberships as $mem) {
				$memberships =R::dispense('doctormemberships');
  				$memberships->docid = $article->docid;	
				$memberships->desc = $mem;
				//$article->docmemberships[] = $memberships;	
				$id = R::store($memberships);
				}	
				
				$input->certifications = explode(":", $input->certifications);
				foreach ($input->certifications as $cer) {
						$certifications =R::dispense('doctorcertifications');
  				$certifications->docid = $article->docid;	
				$certifications->desc = $cer;
				//$article->doccertifications[] = $certifications	;
				$id = R::store($certifications);
				}	
				
				$input->awards = explode(":", $input->awards);
				foreach ($input->awards as $awa) {
				$awards =R::dispense('doctorawards');
  				$awards->docid = $article->docid;	
				$awards->desc = $awa;
				//$article->docawards[] = $awards;
				$id = R::store($awards);
				}	
				
				$id = R::store($article);
				
				$arr=array('status' => $app->response->getStatus(), 'message' => 'saved');
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
