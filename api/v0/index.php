<?php
require 'Slim/Slim.php';
//require 'RedBean/rb.php';
\Slim\Slim::registerAutoloader();
session_cache_limiter(false);
session_start();
$connection = mysqli_connect("localhost", "root", "", "doctornow");

$app = new \Slim\Slim(); // pass an associative array to this if you want to configure the settings

include "endpoint/doctor/profile.php";
include "endpoint/doctor/login.php";
include "endpoint/doctor/search.php";
include "endpoint/doctor/signup.php";
include "endpoint/doctor/appointment.php";

include "endpoint/patient/profile.php";
include "endpoint/patient/login.php";
include "endpoint/patient/signup.php";








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

    $query = mysqli_query($connection, "INSERT INTO '.$doctor_name+$doctor_id.' (patient_id, doctor_id, confirm,busy,appointment_id)
VALUES ('$patient_id','$doctor_id','$confirm','$busy' '$appointment_id')");
    if ($query) {
        echo json_encode("the issue has been added");
    }



});




$app->get('/doctor/getschedule/free/:id', function() use ($app, $connection)
{

  $request   = $app->request();
  $body      = $request->getBody();
  $input     = json_decode($body);


  $doctor_name= $input->doctor_name;

  if(!isset($login_session_user_patient) || !isset($login_session_user_doctor) )
  {
    mysqli_close($connection);

  }



  $result = mysqli_query($connection, "select * from '$doctor_name+$doctor_id' where confirm = 0 and busy = 0");
  $data   = mysqli_fetch_array($result);
  echo json_encode($data);


});

$app->get('/doctor/getschedule/busy', function() use ($app, $connection)


{

  $request   = $app->request();
  $body      = $request->getBody();
  $input     = json_decode($body);
  $doctor_id = $input->doctor_id;
  $doctor_name= $input->doctor_name;


  $result = mysqli_query($connection, "select * from '$doctor_name+$doctor_id' where confirm != 0 and busy != 0");
  $data   = mysqli_fetch_array($result);
  echo json_encode($data);

});


$app->get('/doctor/getschedule/busy/:id', function() use ($app, $connection)
{
  $request   = $app->request();
  $body      = $request->getBody();
  $input     = json_decode($body);
  // i have $id which is appointment id
  $result = mysqli_query($connection, "select * from appointments where id = '$id'");
  $data   = mysqli_fetch_array($result);
  echo json_encode($data);



});
$app->get('/doctor/getschedule/free/:id', function() use ($app, $connection)
{
  $request   = $app->request();
  $body      = $request->getBody();
  $input     = json_decode($body);
  // i have $id which is appointment id
  $result = mysqli_query($connection, "select * from appointments where id = '$id'");
  $data   = mysqli_fetch_array($result);
  echo json_encode($data);


});











$app->run();
?>
