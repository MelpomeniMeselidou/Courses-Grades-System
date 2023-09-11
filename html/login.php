<?php
		 session_start();

$link= mysqli_connect("localhost","root","","pegasus");
if($link == false){
	die("ERROR! CAN NOT CONNECT TO THE DATABASE!");
}


if (!$link) {
		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}
	 $_SESSION['ifLogged_in'] = 'NO';

		include "functions.php";

		$username = mysqli_real_escape_string($link, $_POST['username']);
		$password = mysqli_real_escape_string($link, $_POST['password']);

		if (empty($username) || empty($password)) {
			send_message('You must enter both username and password', 'error');
			header("Location: index.php");
			exit();
	 }




	 if (strpos($username, 'stud') !== false){
		$sql = "SELECT s.student_id, s.first_name, s.last_name, s.role_id, r.description FROM students s, roles r WHERE s.student_id='$username' AND s.password='$password' AND s.role_id = r.role_id";
		$result = mysqli_query($link, $sql) or die(mysqli_error($link));
		$count = mysqli_num_rows($result);

		if ($count == 1) {
			$row = mysqli_fetch_assoc($result);
			$role = $row['role_id'];
			$description = $row['description'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$email = $row['email'];

			$_SESSION['student_id'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['role_id'] = $role;
			$_SESSION['description'] = $description;
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;
			$_SESSION['email'] = $email;

			} else {
			send_message('Wrong information', 'error');
			header("Location: index.php");
		 exit();
		}
 }
 else if (strpos($username, 'prof') !== false){
		$sql = "SELECT p.professor_id, p.first_name, p.last_name, p.role_id, r.description FROM professors p, roles r WHERE p.professor_id='$username' AND p.password='$password' AND p.role_id = r.role_id";
		$result = mysqli_query($link, $sql) or die(mysqli_error($link));
		$count = mysqli_num_rows($result);

		if ($count == 1) {
			$row = mysqli_fetch_assoc($result);
			$role = $row['role_id'];
			$description = $row['description'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$email = $row['email'];

			$_SESSION['professor_id'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['role_id'] = $role;
			$_SESSION['description'] = $description;
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;
			$_SESSION['email'] = $email;

			} else {
			send_message('Wrong information', 'error');
			header("Location: index.php");
		 exit();
		}
 }
 else if (strpos($username, 'admin') !== false){
		 $sql = "SELECT a.administrator_id, a.first_name, a.last_name, a.role_id, r.description, a.email FROM administrators a, roles r WHERE a.administrator_id='$username' AND a.password='$password' AND a.role_id = r.role_id";
		$result = mysqli_query($link, $sql) or die(mysqli_error($link));
		$count = mysqli_num_rows($result);

		if ($count == 1) {
			$row = mysqli_fetch_assoc($result);
			$role = $row['role_id'];
			$description = $row['description'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$email = $row['email'];

			$_SESSION['administrator_id'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['role_id'] = $role;
			$_SESSION['description'] = $description;
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;
			$_SESSION['email'] = $email;


			} else {
			send_message('Wrong information', 'error');
			header("Location: index.php");
		 exit();
		}
 }
 else{
	 send_message('Wrong information', 'error');
			header("Location: index.php");
		 exit();
 }
		 switch ($_SESSION['role_id']) {
	     case 1: //Student
			 $_SESSION['loggedin_as'] = "Student";
			 $_SESSION['ifLogged_in'] = 'YES';
             header("Location: student_main.php");
             exit();
             break;
		 case 2: //Professor

			 $_SESSION['loggedin_as'] = "Professor";
			 $_SESSION['ifLogged_in'] = 'YES';
             header("Location: prof_main.php");
             exit();
             break;

		 case 3: //Administrator

			 $_SESSION['loggedin_as'] = "Administrator";
			 $_SESSION['ifLogged_in'] = 'YES';
             header("Location: admin_main.php");
             exit();
             break;

		default:
			header("Location: 404.php");
		 }
	?>
