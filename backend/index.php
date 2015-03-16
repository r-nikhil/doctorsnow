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


if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  echo("$email is a valid email address");

$query=mysqli_query($connection, "INSERT INTO signup (name, email, phone, city, speciality)
VALUES ('$namee','$email','$phone','$city','$speciality')" );
if($query){echo json_encode("the doctor has been added");}

} else {
  echo("$email is not a valid email address");
}
});

$app->post('/patient', function () use ($app,$connection) {
  $request = $app->request();
  $body = $request->getBody();
  $input = json_decode($body);
  $name=$input->name;
  $issue=$input->issue;

$query=mysqli_query($connection, "INSERT INTO patient (name, issue)
VALUES ('$name','$issue')" );
if($query){echo json_encode("the issue has been added");}

});


$app->post('/patient', function () use ($app,$connection) {
$request = $app->request();
  $body = $request->getBody();
  $input = json_decode($body);
  $patient







});



$app->run();
?>
