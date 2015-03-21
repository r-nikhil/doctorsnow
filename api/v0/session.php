<?php
// session_start();

$connection = mysqli_connect("localhost", "root", "", "instaconsult");

$login_patient = $_SESSION['login_patient'];

$result=mysqli_query($connection, "select username from login_patient where username= '$login_patient'");

$row = mysqli_fetch_assoc($result);

$login_session_user  = $row['username']; // this extra time reassigning and search happens for safety


// $test = mysqli_fetch_assoc($fields);

// $open_project_id=$fields['open_project_id'];
//
// $closed_project_id=$fields['closed_project_id'];
// $accepted_project_id=$fields['accepted_project_id'];
// $closed_project_id=$fields['closed_project_id'];


if(!isset($login_session_user))
{
mysqli_close($connection); // Closing Connection
// header('Location: index.php'); // This has to be changed. Come back to this at the end
}

?>