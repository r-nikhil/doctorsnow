<?php
require 'Slim/Slim.php';
//require 'RedBean/rb.php';
\Slim\Slim::registerAutoloader();
session_cache_limiter(false);
session_start();
$connection = mysqli_connect("localhost", "root", "", "doctornow");
// include 'db.php';

$app = new \Slim\Slim(); // pass an associative array to this if you want to configure the settings



// the above code adds new row in the patient table


// for the below code, lets sit together and finish it tonight... front + back.. until then, you try integrating the front\

// down here are the functions you asked for
/// this one get doctor by id

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
// this one return whenever the doctor is free


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
// below code is for retrieving doctors by category

$app->get('/doctor/search/category/:id', function() use ($app, $connection)
{

    $request   = $app->request();
    $body      = $request->getBody();
    $input     = json_decode($body);
    $doctor_id = $input->doctor_id;
    $tablename= "category"+$id;


    $result = mysqli_query($connection, "select * from '.$tablename.' where doctor_id='$doctor_id'");
    $data   = mysqli_fetch_array($result);

    echo json_encode($data);



});


$app->get('/doctor/search/name/:name', function() use ($app, $connection)
{

  $request   = $app->request();
  $body      = $request->getBody();
  $input     = json_decode($body);


  $result = mysqli_query($connection, "select * from doc_profile where full_name='$name'");
  $data   = mysqli_fetch_array($result);

  echo json_encode($data);

});
$app->get('/doctor/search/city/:city', function() use ($app, $connection)
{

  $request   = $app->request();
  $body      = $request->getBody();
  $input     = json_decode($body);


  $result = mysqli_query($connection, "select * from doc_profile where city='$city'");
  $data   = mysqli_fetch_array($result);

  echo json_encode($data);

});





// retrieve doctors by category done
// now moving on to slots and all that


$app->get('/doctor/getschedule/free/:id', function() use ($app, $connection)
{

  $request   = $app->request();
  $body      = $request->getBody();
  $input     = json_decode($body);


  $doctor_name= $input->doctor_name;

  if(!isset($login_session_user_patient) || !isset($login_session_user_doctor) )
  {
    mysqli_close($connection);
    // Closing Connection
    // header('Location: index.php'); // This has to be changed. Come back to this at the end
    // put the whole thing under a if statement
  }



  $result = mysqli_query($connection, "select * from '$doctor_name+$doctor_id' where confirm = 0 and busy = 0");
  $data   = mysqli_fetch_array($result);
  echo json_encode($data);
  // now you have all appointment id

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
  // now you have all appointment id

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

  // i am sending you all the busy ones

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

  // i am sending you all the free ones

});

// I think this you have to do a lot in the frontend with what I have done here. Let's sit together we can fine tune this. I can code more logic into here. I am not able to do it now without much clarity
// I want to know what all you want and what is easy for you so that minimum amount of work is done by js. Get back to me with what all routes you want.

include "endpoint/test.php";









$app->run();
?>
