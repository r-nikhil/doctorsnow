<?php


$app->get('/doctor/:name/:id/appo', function() use ($app, $connection)
{
//http://stackoverflow.com/questions/25493942/mysql-how-to-generate-a-complete-calendar-from-an-interval
// use that link for future use. ITS awesome
  include "session.php";
  if(isset($login_session_user_patient) || isset($login_session_user_doctor) )
    {
$name = $login_session_user_doctor;
// pass from date and end date here.

$fromdate = date("Y-m-d");
$todate = date("Y-m-d",strtotime("+1 week"));

// we have $id
$result = mysqli_query($connection, "select * from  '.$name_$id.' where date BETWEEN '$fromdate' and '$todate'");
$data   = mysqli_fetch_array($result);

  }
else
{
  echo " login first bitch";
}



});
