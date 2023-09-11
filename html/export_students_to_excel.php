<?php
session_start();
if($_SESSION['role_id']!= 2){
	header("Location: 401.php");
}
if(isset($_GET['course_id'])){
$course_id = $_GET['course_id'];
$professor_id = $_SESSION['professor_id'];



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pegasus";
//mysql and db connection

$con =  mysqli_connect("localhost","root","","pegasus");

if ($con->connect_error) {  //error check
    die("Connection failed: " . $con->connect_error);
}


$filename = "Students";  //your_file_name
$file_ending = "xls";   //file_extention

header("Content-Type: application/xlsx");
header("Content-Disposition: attachment; filename=$filename.$file_ending");
header("Pragma: no-cache");
header("Expires: 0");

$sep = "\t";

$sql="SELECT s.student_id, s.first_name, s.last_name, s.email, cs.statement_semester
FROM courses c, students s, course_statements cs
WHERE cs.course_id = '$course_id'
			AND c.course_id = cs.course_id
			AND c.professor_id = '$professor_id'
			AND s.student_id = cs.student_id";
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
