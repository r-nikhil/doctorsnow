<?php
require 'Slim/Slim.php';
//require 'RedBean/rb.php';
\Slim\Slim::registerAutoloader();
session_cache_limiter(false);
session_start();
$connection = mysqli_connect("localhost", "root", "", "doctornow");
// include 'db.php';

$app = new \Slim\Slim(); // pass an associative array to this if you want to configure the settings




// you wanted the id of doctor/patient while logging in. But I am giving you everything when you log in and redirtect to profile_doctor. Will that do ?

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
});
/////////////////////////////////////////////////////////// the password hash is not generated now. login_patient ends here


$app->post('/login_doctor', function() use ($app, $connection)
{

    $body     = $app->request->getBody();
    $req      = $app->request();
    $result   = json_decode($body);
    $username = $result->username;
    $password = $result->password;

    $query = mysqli_query($connection, "select * from login_doctor where username='$username'");
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

    $query = mysqli_query($connection, "select * from login_doctor where username='$username' and password = '$password'");
    $rows1  = mysqli_num_rows($query);
    if ($rows1 == 1) { // the user logs in here

        $_SESSION['login_doctor'] = $username; // after the user logs the session variable is assigned.
        $arr = array(
            'status' => 'true',
            'message' => 'logged in bitches'
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


/////////////////////////////////////////////////////////// the password hash is not generated now. login_doctor ends here

// everything until here works

$app->get('/profile_patient', function() use ($app, $connection)
{
    include "session.php";

    $body   = $app->request->getBody();
    $result = json_decode($body);

    $result = mysqli_query($connection, "select * from profile_patient where username='$login_session_user_patient'");
    $data   = mysqli_fetch_array($result);

    echo json_encode($data);

    $app->response()->header('Content-Type', 'application/json');


});

$app->get('/profile_doctor', function() use ($app, $connection)
{
    include('session.php');
    $body   = $app->request->getBody();
    $result = json_decode($body);


    $result = mysqli_query($connection, "select * from profile_doctor where username='$login_session_user_doctor'");
    $data   = mysqli_fetch_array($result);

    echo json_encode($data);

    $app->response()->header('Content-Type', 'application/json');
});

// I think the profile details ends here for both doctors and patient


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

        $query = mysqli_query($connection, "INSERT INTO profile_doctor (name, email, phone, city, speciality, experience)
VALUES ('$namee','$email','$phone','$city','$speciality', '$experience')");
        if ($query) {
            echo json_encode("the doctor has been added");
        }

    } else {
        echo ("$email is not a valid email address");
    }

    $query= mysqli_query($connection, "select id from profile_doctor where name ='$name'")
    $data   = mysqli_fetch_array($query);
    $doctor_id=$data[0];
    echo json_encode($doctor_id);

  $sql=   CREATE TABLE IF NOT EXISTS `$doctor_id+$name` (
    `id` varchar(20) NOT NULL,
    `patient_id` int(12) NOT NULL,
    `doctor_id` int(12) NOT NULL,
    `confirm` int(12) NOT NULL,
    `busy` int(12) NOT NULL,
    `appointment_id` int(12) NOT NULL,
    
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;



});
// the baove code adds a new row in the doctor table


$app->post('/create_patient', function() use ($app, $connection)
{
    $request   = $app->request();
    $body      = $request->getBody();
    $input     = json_decode($body);
    $name      = $input->name;
    $allergies = $input->allergies;
    $age       = $input->age;
    $blood     = $input->blood;


    $query = mysqli_query($connection, "INSERT INTO profile_patient (name, issue, age, allergies, blood)
VALUES ('$name','$issue','$age','$allergies','$blood')");
    if ($query) {
        echo json_encode("the issue has been added");
    }

});

// the above code adds new row in the patient table


// for the below code, lets sit together and finish it tonight... front + back.. until then, you try integrating the front\

// down here are the functions you asked for
/// this one get doctor by id

$app->post('/doctors/:id', function() use ($app, $connection)
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

    $query = mysqli_query($connection, "INSERT INTO docname_docid (patient_id, doctor_id, confirm,busy,appointment_id)
VALUES ('$patient_id','$doctor_id','$confirm','$busy' '$appointment_id')");
    if ($query) {
        echo json_encode("the issue has been added");
    }



});
// below code is for retrieving doctors by category

$app->put('/category1', function() use ($app, $connection)
{

    $request   = $app->request();
    $body      = $request->getBody();
    $input     = json_decode($body);
    $doctor_id = $input->doctor_id;

    $result = mysqli_query($connection, "select * from category1 where doctor_id='$doctor_id'");
    $data   = mysqli_fetch_array($result);

    echo json_encode($data);



});

$app->put('/category2', function() use ($app, $connection)
{

    $request   = $app->request();
    $body      = $request->getBody();
    $input     = json_decode($body);
    $doctor_id = $input->doctor_id;

    $result = mysqli_query($connection, "select * from category2 where doctor_id='$doctor_id'");
    $data   = mysqli_fetch_array($result);

    echo json_encode($data);



});


$app->put('/category3', function() use ($app, $connection)
{

    $request   = $app->request();
    $body      = $request->getBody();
    $input     = json_decode($body);
    $doctor_id = $input->doctor_id;

    $result = mysqli_query($connection, "select * from category3 where doctor_id='$doctor_id'");
    $data   = mysqli_fetch_array($result);

    echo json_encode($data);



});

$app->put('/category4', function() use ($app, $connection)
{

    $request   = $app->request();
    $body      = $request->getBody();
    $input     = json_decode($body);
    $doctor_id = $input->doctor_id;

    $result = mysqli_query($connection, "select * from category4 where doctor_id='$doctor_id'");
    $data   = mysqli_fetch_array($result);

    echo json_encode($data);

});

// retrieve doctors by category done
// now moving on to slots and all that











$app->run();
?>
