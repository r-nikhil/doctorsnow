<?php
$app->post('/patient/login', function() use ($app, $connection)
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
});
?>
