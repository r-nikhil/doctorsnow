<?php
require 'Slim/Slim.php';
//require 'RedBean/rb.php';
\Slim\Slim::registerAutoloader();
session_cache_limiter(false);
session_start();
$connection = mysqli_connect("localhost", "root", "", "doctornow");


$app = new \Slim\Slim(); // pass an associative array to this if you want to configure the settings


$app->post('/doctor/profile/:id', function() use ($app, $connection){
if(isset($login_session_user_patient) || isset($login_session_user_doctor))
{

$result = mysqli_query($connection, "select * from profile_doctor where id='$id'");
$data   = mysqli_fetch_array($result);

echo json_encode($data);

$app->response()->header('Content-Type', 'application/json');

}
else
{
  echo json_encode("login first and then try to access all the doctors");

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
