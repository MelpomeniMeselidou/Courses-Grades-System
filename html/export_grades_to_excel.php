<?php
session_start();
if($_SESSION['role_id']!= 2){
	header("Location: 401.php");
}
if(isset($_GET['course_id']) ){
$course_id = $_GET['course_id'];
$professor_id = $_SESSION['professor_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pegasus";
//mysql and db connection

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {  //error check
    die("Connection failed: " . $con->connect_error);
}


$filename = "Grades";  //your_file_name
$file_ending = "xls";   //file_extention


//eader("Content-Type: application/xls");
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.$file_ending");  
header("Pragma: no-cache");
header("Expires: 0");

$sep = "\t";


  			$sql = "SELECT g.grade_id, c.title, s.student_id, s.first_name,  s.last_name , c.semester,
			g.theory_grade, g.labratory_grade, g.final_grade, g.ifFinalized
  			FROM courses c, students s, grades g
  			WHERE c.professor_id = 'prof001'
						AND g.course_id = 'course001'
  						AND s.student_id = g.student_id";
$result = $con->query($sql);
while ($property = mysqli_fetch_field($result)) { //fetch table field name
    echo $property->name."\t";
}

print("\n");

while($row = mysqli_fetch_row($result))  //fetch_table_data
{
    $schema_insert = "";
    for($j=0; $j< mysqli_num_fields($result);$j++)
    {
        if(!isset($row[$j]))
            $schema_insert .= "NULL".$sep;
        elseif ($row[$j] != "")
            $schema_insert .= "$row[$j]".$sep;
        else
            $schema_insert .= "".$sep;
    }
    $schema_insert = str_replace($sep."$", "", $schema_insert);
    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    $schema_insert .= "\t";
    print(trim($schema_insert));
    print "\n";
}
}

?>
