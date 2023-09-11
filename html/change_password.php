<?php

session_start();
$role_id =  $_SESSION['role_id'];
$link= mysqli_connect("localhost","root","","pegasus");
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}


 if (isset($_POST['new_password']) && isset($_POST['confirmed_password'])) {

 function validate($data){
    $data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
 }


 $new_password = validate($_POST['new_password']);
 $confirmed_password = validate($_POST['confirmed_password']);



	if(empty($new_password)){
     header("Location: change-password.php?error=New password is required!");
	 exit();
    }
	else if(empty($confirmed_password)){
     header("Location: change-password.php?error=Confirmed password is required!");
	 exit();
    } else if($new_password != $confirmed_password){
	header("Location: change-password.php?error=Both passwords must match!");
	 exit();
	}
	else {
    if($role_id == 1){
	$user_id = $_SESSION['student_id'];

        	 $sql = "UPDATE students
        	           SET password='$new_password'
        	           WHERE student_id ='$user_id'";
        	 $result = $link->query($sql);

}else if($role_id == 2){
	$user_id = $_SESSION['professor_id'];

        	 $sql = "UPDATE professors
        	           SET password='$new_password'
        	           WHERE professor_id ='$user_id'";
        	 $result = $link->query($sql);
}else if($role_id == 3){
	$user_id = $_SESSION['administrator_id'];

        	 $sql = "UPDATE administrators
        	           SET password='$new_password'
        	           WHERE administrator_id ='$user_id'";
        	 $result = $link->query($sql);
}
	 header("Location: profile.php?success=Your information has been changed successfully");
	 exit();
   }

}
header("Location: profile.php?success=ERROR");
?>
