<?php


$app->post('/doctor/profile', function() use ($app, $connection)
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

    $query = mysqli_query($connection, "INSERT INTO doc_profile (name, email, phone, city, speciality, experience)
    VALUES ('$namee','$email','$phone','$city','$speciality', '$experience')");
    if ($query) {
      echo json_encode("the doctor has been added");
    }

  }
  else {
    echo ("$email is not a valid email address");
  }

  $query = mysqli_query($connection, "select id from doc_profile where name ='$name'");
  $data = mysqli_fetch_array($query);
  $doctor_id=$data[0];
  echo json_encode($doctor_id);

  $sql=   "CREATE TABLE IF NOT EXISTS `.$doctor_id+$name.` (
  `id` varchar(20) NOT NULL,
  `patient_id` int(12) NOT NULL,
  `doctor_id` int(12) NOT NULL,
  `confirm` int(12) NOT NULL,
  `busy` int(12) NOT NULL,
  `appointment_id` int(12) NOT NULL,

  PRIMARY KEY (`id`)
  )";

  if (mysqli_query($connection,$sql))
  {
    echo "new doctor table created successfully";



  }
  else
  {
    echo "Error creating table: " . mysqli_error($con);
  }




});
?>
