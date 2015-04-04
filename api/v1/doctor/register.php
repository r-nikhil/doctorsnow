<?php
//<<<<<<< HEAD
//=======
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
		$article->doccategory = $app->request->post('category');
		$article->docname = $app->request->post('firstName')." ".$app->request->post('lastName');  ; // this column is for search

		$id = R::store($article);

		//$app->response()->header('Content-Type', 'application/json');
		//$app->response()->set->contentType('application/json');

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
	//>>>>>>> origin/netham
});
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
		//$article->docpassword = (string)$input->password;  
		$article->doccategory = (string)$input->category;  	
		$article->doctype = (string)$input->docType;  	
		$article->docname = (string)$input->firstName." ".(string)$input->lastName;  ; // this column is for search
		$id = R::store($article);
		
		$arr=array('status' => $app->response->getStatus(), 'message' => 'Registered');
		$app->response()->header('Content-Type', 'application/json');
		$msg=json_encode($arr );
		$app->response->body($msg );

	}
	catch (Exception $e) {
		$arr=array('status' => $app->response->getStatus(), 'message' => ' '. $e->getMessage().' ');
		$app->response()->header('Content-Type', 'application/json');
		$msg=json_encode($arr );
		$app->response->body($msg );

	}
});


$app->post('/doctor/uploadpic', function() use ($app) {
	try {
		
		$id= $_SESSION['docId'];
		$id= 1;
		
		if (!isset($_FILES['uploads'])) {
			$arr=array('status' => $app->response->getStatus(), 'message' => 'NoFile');
			$app->response()->header('Content-Type', 'application/json');
			$msg=json_encode($arr );
			$app->response->body($msg );
		}
		else {
			$imgs = array();
			$files = $_FILES['uploads'];
			$cnt = count($files['name']);

			for($i = 0 ; $i < $cnt ; $i++) {
					$name = $id;
				if ($files['error'][$i] === 0) {
					if (move_uploaded_file($files['tmp_name'][$i], 'images/docpic/' . $name) === true) {
						$imgs[] = array('url' => '/uploads/' . $name, 'name' => $files['name'][$i]);
					}

				}
			}
			/*$imageCount = count($imgs);
			if ($imageCount == 0) {
				echo 'No files uploaded!!  <p><a href="/">Try again</a>';
				return;
			}
			$plural = ($imageCount == 1) ? '' : 's';
			foreach($imgs as $img) {
				printf('%s <img src="%s" width="50" height="50" /><br/>', $img['name'], $img['url']);
			}
			*/
			$article = R::findOne('doctorsprofile', 'id=?', array($id));
			$article->docpic = $imgs[0]['url'];
			
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
