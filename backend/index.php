<?php
require 'Slim/Slim.php';
// require 'RedBean/rb.php';
\Slim\Slim::registerAutoloader();
session_cache_limiter(false);
session_start();
$connection = mysqli_connect("localhost", "root", "", "doctornow");
include 'db.php';
$app = new \Slim\Slim();                    // pass an associative array to this if you want to configure the settings



$app->post('/create_doctor', function () use ($app,$connection) {
  $request = $app->request();
  $body = $request->getBody();
  $input = json_decode($body);
  $name=$input->name;
  $email=$input->email;
  $phone=$input->phone;
  $city=$input->city;
  $speciality=$input->speciality;
  $experience=$input->experience;

if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  echo("$email is a valid email address");

$query=mysqli_query($connection, "INSERT INTO doctor_details (name, email, phone, city, speciality, experience)
VALUES ('$namee','$email','$phone','$city','$speciality', '$experience')" );
if($query){echo json_encode("the doctor has been added");}

} else {
  echo("$email is not a valid email address");
}
});


$app->post('/patient_details', function () use ($app,$connection) {
  $request = $app->request();
  $body = $request->getBody();
  $input = json_decode($body);
  $name=$input->name;
  $allergies=$input->allergies;
  $age=$input->age;
  $blood=$input->blood;


$query=mysqli_query($connection, "INSERT INTO patient (name, issue, age, allergies, blood)
VALUES ('$name','$issue','$age','$allergies','$blood')" );
if($query){echo json_encode("the issue has been added");}

});






$app->post('/appointment', function () use ($app,$connection) {
$request = $app->request();
  $body = $request->getBody();
  $input = json_decode($body);
  $patient_id=$input->patient_id;
  $doctor_id=$input->doctor_id;
  $time=$input->time;
  $date=$input->date;
  $details=$input->details;
  $previous_med=$input->previous_med;
  $confirm=$input->confirm;
  $chat_url=$input->chat_url;



$query=mysqli_query($connection, "INSERT INTO appointment (patient_id, doctor_id, time, date, details, previous_med, confirm, chat_url)
VALUES ('$patient_id','$doctor_id','$time','$date','$details','$previous_med','$confirm', '$chat_url')" );
if($query){echo json_encode("the issue has been added");}




});


$app->put('/make_appointment', function () use ($app,$connection) {
$request = $app->request();
  $body = $request->getBody();
  $input = json_decode($body);
  $patient_id=$input->patient_id;
  $doctor_id=$input->doctor_id;
  $link=$input->link;

});




$app->run();
?>
