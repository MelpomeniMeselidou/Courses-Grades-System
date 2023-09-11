
 
<!DOCTYPE html>

	<?php 
	
$link= mysqli_connect("localhost","root","","pegasus");
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}
	
	
			$password = $_POST['password'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$role_id = $_POST['role_id'];
				
			
			
		   
			$sql = "INSERT INTO student_registration_requests (first_name, last_name, password, contact_email, student_request_id, role_id)VALUES ('$first_name', '$last_name', '$password', '$email', studentID(), '$role_id')";
	
			mysqli_query($link, $sql);
			
			
			
		   
			header("location: index.php");
		   
		  
		
	?> 
