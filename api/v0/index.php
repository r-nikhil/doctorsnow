<?php
require 'Slim/Slim.php';
//require 'RedBean/rb.php';
\Slim\Slim::registerAutoloader();
session_cache_limiter(false);
session_start();
$connection = mysqli_connect("localhost", "root", "", "doctornow");
// include 'db.php';

$app = new \Slim\Slim(); // pass an associative array to this if you want to configure the settings

$app->post('/login_patient', function() use ($app, $connection)
{
    
    $body     = $app->request->getBody();
    $req      = $app->request();
    $result   = json_decode($body);
    $username = $result->username;
    $password = $result->password;
    
    $query = mysqli_query($connection, "select * from login_patient where username='$username'");
    $rows  = mysqli_num_rows($query);
    if ($rows ==1){
    $arr = array(
            'status' => 'true',
            'message' => 'username exists'
        );
        $app->response()->header('Content-Type', 'application/json');
        echo json_encode($arr);

    }

else{
    $arr = array(
            'status' => 'true',
            'message' => 'username itself does not exists'
        );
        $app->response()->header('Content-Type', 'application/json');
        echo json_encode($arr);
}

    $query = mysqli_query($connection, "select * from login_patient where username='$username' and password = '$password'");
    $rows1  = mysqli_num_rows($query);
    if ($rows1 == 1) { // the user logs in here
        
        $_SESSION['login_patient'] = $username; // after the user logs the session variable is assigned.
        $arr = array(
            'status' => 'true',
            'message' => 'true'
        );
        $app->response()->header('Content-Type', 'application/json');
        echo json_encode($arr);
    } 
    else {
        $arr = array(
            'status' => 'true',
            'message' => 'wrong username AND password'
        );

        $app->response()->header('Content-Type', 'application/json');
        echo json_encode($arr);
    }
    mysqli_close($connection);
/////////////////////////////////////////////////////////// 


                   

$app->post('/login_patient', function () use ($app,$connection) {

 $body = $app->request->getBody();
 $req = $app->request();
 $result=  json_decode($body);
 $username=$result->username; $password=$result->password;
 
//make a change here. Do query only by username. Then compare password outside. If the query fails then it means he is not
//registered, send this message. If query is right and comparison fails then it means his password is wrong.

 //okok.. fine fine. I d wasnt thinking that much while making the product. I just wrote it for auth. As you see I am not even handling errors proerly
 // I will do it now// Sorry
  
  
$query = mysqli_query($connection, "select * from login_patient where password='$password' AND username='$username'");
$rows = mysqli_num_rows($query);

if ($rows == 1) {
 
	$_SESSION['login_patient']=$username; // after the user logs the session variable is assigned.
	$arr=array('status' => 'success', 'message' => 'true');
	$app->response()->header('Content-Type', 'application/json');
	echo json_encode($arr);
}
else {
    $arr=array('status' => 'success', 'message' => 'wrong email or password');

    $app->response()->header('Content-Type', 'application/json');
});

$app->get('/profile_patient', function() use ($app, $connection)
{
    include('db.php');
    $body   = $app->request->getBody();
    $result = json_decode($body);
    
    
    $result = mysqli_query($connection, "select * from patient_details where username='$login_session_user'");
    $data   = mysqli_fetch_array($result);
    
    echo json_encode($data);
    
    $app->response()->header('Content-Type', 'application/json');
    
    
});


$app->post('/login_doctor', function() use ($app, $connection)
{
    
    $body     = $app->request->getBody();
    $result   = json_decode($body);
    $username = $result->username;
    $password = $result->password;
    
    $result = mysqli_query($connection, "select * from login_doctor where password='$password' AND username='$username'");
    
    $rows = mysqli_num_rows($result);
    
    if ($rows == 1) {
        //$_SESSION['login_doctor']=$username; // after the user logs the session variable is assigned.
        // $app->redirect('profile_doctor');
        echo json_encode("True");
    }
    
    else {
        echo json_encode("Username or Password is invalid");
    }
    mysqli_close($connection);
    
    
    $app->response()->header('Content-Type', 'application/json');
});



$app->get('/profile_doctor', function() use ($app, $connection)
{
    include('db.php');
    $body   = $app->request->getBody();
    $result = json_decode($body);
    
    
    $result = mysqli_query($connection, "select * from doctor_details where username='$login_session_user'");
    $data   = mysqli_fetch_array($result);
    
    echo json_encode($data);
    
    $app->response()->header('Content-Type', 'application/json');
});


$app->post('/create_doctor', function() use ($app, $connection)
{
    $request    = $app->request();
    $body       = $request->getBody();
    $input      = json_decode($body);
    $name       = $input->name;
    $email      = $input->email;
    $phone      = $input->phone;
    $city       = $input->city;
    $speciality = $input->speciality;
    $experience = $input->experience;
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo ("$email is a valid email address");
        
        $query = mysqli_query($connection, "INSERT INTO doctor_details (name, email, phone, city, speciality, experience)
VALUES ('$namee','$email','$phone','$city','$speciality', '$experience')");
        if ($query) {
            echo json_encode("the doctor has been added");
        }
        
    } else {
        echo ("$email is not a valid email address");
    }
});


$app->post('/patient_details', function() use ($app, $connection)
{
    $request   = $app->request();
    $body      = $request->getBody();
    $input     = json_decode($body);
    $name      = $input->name;
    $allergies = $input->allergies;
    $age       = $input->age;
    $blood     = $input->blood;
    
    
    $query = mysqli_query($connection, "INSERT INTO patient (name, issue, age, allergies, blood)
VALUES ('$name','$issue','$age','$allergies','$blood')");
    if ($query) {
        echo json_encode("the issue has been added");
    }
    
});






$app->post('/appointment', function() use ($app, $connection)
{
    $request      = $app->request();
    $body         = $request->getBody();
    $input        = json_decode($body);
    $patient_id   = $input->patient_id;
    $doctor_id    = $input->doctor_id;
    $time         = $input->time;
    $date         = $input->date;
    $details      = $input->details;
    $previous_med = $input->previous_med;
    $confirm      = $input->confirm;
    $chat_url     = $input->chat_url;
    
    
    
    $query = mysqli_query($connection, "INSERT INTO appointment (patient_id, doctor_id, time, date, details, previous_med, confirm, chat_url)
VALUES ('$patient_id','$doctor_id','$time','$date','$details','$previous_med','$confirm', '$chat_url')");
    if ($query) {
        echo json_encode("the issue has been added");
    }
    
    
});

$app->put('/slot', function() use ($app, $connection)
{
    $request        = $app->request();
    $body           = $request->getBody();
    $input          = json_decode($body);
    $patient_id     = $input->patient_id;
    $doctor_id      = $input->doctor_id;
    $confirm        = $input->confirm;
    $busy           = $input->busy;
    $appointment_id = $input->appointment_id;
    
    $query = mysqli_query($connection, "INSERT INTO docname_docid (patient_id, doctor_id, confirm,busy,appointment_id)
VALUES ('$patient_id','$doctor_id','$confirm','$busy' '$appointment_id')");
    if ($query) {
        echo json_encode("the issue has been added");
    }
    
    
    // this has to be worked on
});


$app->put('/category1', function() use ($app, $connection)
{
    
    $request   = $app->request();
    $body      = $request->getBody();
    $input     = json_decode($body);
    $doctor_id = $input->doctor_id;
    
    $result = mysqli_query($connection, "select * from category1 where doctor_id='$doctor_id'");
    
    
    
});

$app->put('/category2', function() use ($app, $connection)
{
    
    $request   = $app->request();
    $body      = $request->getBody();
    $input     = json_decode($body);
    $doctor_id = $input->doctor_id;
    
    $result = mysqli_query($connection, "select * from category2 where doctor_id='$doctor_id'");
    
    
    
});


$app->put('/category3', function() use ($app, $connection)
{
    
    $request   = $app->request();
    $body      = $request->getBody();
    $input     = json_decode($body);
    $doctor_id = $input->doctor_id;
    
    $result = mysqli_query($connection, "select * from category3 where doctor_id='$doctor_id'");
    
    
    
});

$app->put('/category4', function() use ($app, $connection)
{
    
    $request   = $app->request();
    $body      = $request->getBody();
    $input     = json_decode($body);
    $doctor_id = $input->doctor_id;
    
    $result = mysqli_query($connection, "select * from category4 where doctor_id='$doctor_id'");
    
});







$app->run();
?>
