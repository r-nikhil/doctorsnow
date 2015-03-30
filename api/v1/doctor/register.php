<?php

$app->post('/doctor/register', function() use ($app) {

	try {
		//getting json and decoding it
		$request = $app->request();
		$body = $request->getBody();
		$input = json_decode($body);
		// storing to DB
		$article = R::dispense('doctorregister');
		$article->docfname = (string)$input->firstName;
		$article->doclname = (string)$input->lastName;
		$article->docmobile = (string)$input->mobile;
		$article->docemail = (string)$input->email;
		$article->docpassword = (string)$input->password;
		$id = R::store($article);

		// we are also storing those fields in docs profile
		$article = R::dispense('doctorsprofile');
		$article->docfname = (string)$input->firstName;
		$article->doclname = (string)$input->lastName;
		$article->docmobile = (string)$input->mobile;
		$article->docemail = (string)$input->email;
		$article->docpassword = (string)$input->password;  
		$article->doccategory = (string)$input->category;  	
		$article->doctype = (string)$input->docType;  	
		$article->docname = (string)$input->firstName." ".(string)$input->lastName;  ; // this column is for search
		$id = R::store($article);
	
		$arr=array('status' => '200', 'message' => 'Registered');
		$app->response()->header('Content-Type', 'application/json');
		$msg=json_encode($arr );
		$app->response->body($msg );

	}
	catch (Exception $e) {
		$arr=array('status' => '400', 'message' => ' '. $e->getMessage().' ');
		$app->response()->header('Content-Type', 'application/json');
		$msg=json_encode($arr );
		$app->response->body($msg );

	}
});
?>
