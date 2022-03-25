<?php 
	
		$drive_id = "";
		$donor_id = "";
		$date = "";
		$time = "";
		$available = "";
		$id = "";

	include 'db.inc.php';

    if (isset($_POST['submit']))
    {
      //add appointment
      $drive_id = $_POST['drive_id'];
      $donor_id = $_POST['donor_id'];
      $date = $_POST['date'];
      $time = $_POST['time'];
  
      $date = date('Y-m-d', strtotime($date));
      $time = date('H:i:s', strtotime($time));
          $query = "INSERT INTO appointment (drive_id, donor_id, date, time)
                      VALUES ('$drive_id','$donor_id','$date','$time')";
                          

      mysqli_query($conn, $query);

      //update donor available to appointment
      $available = mysqli_real_escape_string($conn, $_POST['available']);
      $id = mysqli_real_escape_string($conn, $_POST['donor_id']);

      mysqli_query($conn, "UPDATE donor SET available = '$available' WHERE id=$id") or die( mysqli_error($conn));

		
      $message = 'Appointment set.';

      echo "<script> 
        alert('$message')
        window.location.replace('../donor_drives.php');
        </script>";
      //header('location: ../donor_drives.php?apptdone');
    }