<?php


$app->get('/doctor/:id/appo', function() use ($app, $connection)
{

  include "session.php";
  if(isset($login_session_user_patient) || isset($login_session_user_doctor) )
    {

// we have $id
$result = mysqli_query($connection, "select * from doc_profile where username='$login_session_user_doctor'");
$data   = mysqli_fetch_array($result);


  }




});
