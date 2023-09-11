
<?php
session_start(); 
$student_id = $_SESSION['student_id'];
$link= mysqli_connect("localhost","root","","pegasus");
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}
if(isset($_POST['courses'])){
    foreach($_POST['courses'] as $course_id){
		echo $course_id;
        

                              $link->query("INSERT INTO course_statements (statement_id, statement_semester, course_id, student_id, ifFinalized)
                          VALUES (stateID(), 1, '$course_id', '$student_id', 1)");
							  echo 'executed';
    }
} 
 header("Location: stud_main.php");

							  ?>