<!DOCTYPE html>
<html lang="el" dir="ltr">
<?php session_start();
$professor_id = $_SESSION['professor_id'];
$link= mysqli_connect("localhost","root","","pegasus");
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}

if($_SESSION['role_id']!= 2){
	header("Location: 401.php");
}
?>
<?php
if(isset($_GET['task']) && $_GET["task"] == "finalize"){
$grade_id =$_GET['grade_id'];


$sqlup = "UPDATE grades
        	           SET ifFinalized = 1
        	           WHERE grade_id='$grade_id' ";
        	 mysqli_query($link, $sqlup);
}
?>
<?php
if(isset($_GET['task']) && $_GET["task"] == "unfinalize"){
$grade_id =$_GET['grade_id'];


$sqlup = "UPDATE grades
        	           SET ifFinalized = 0
        	           WHERE grade_id='$grade_id' ";
        	 mysqli_query($link, $sqlup);
}
?>
<?php
if(isset($_GET['task']) && $_GET["task"] == "delete"){
$grade_id =$_GET['grade_id'];


$sqlup = "DELETE FROM grades
        	           WHERE grade_id='$grade_id' ";
        	 mysqli_query($link, $sqlup);
}
?>
<?php
if(isset($_GET['task']) && $_GET["task"] == "edit"){
$grade_id =$_GET['grade_id'];
$theory_grade =$_POST['theory_grade'];
$labratory_grade =$_POST['labratory_grade'];
$final_grade =$_POST['final_grade'];


$sqlup = "UPDATE grades SET grade_id = '$grade_id', theory_grade = '$theory_grade', labratory_grade = '$labratory_grade', final_grade = '$final_grade'
 WHERE grade_id='$grade_id'";
 mysqli_query($link, $sqlup);
}
?>
<?php
if(isset($_GET['task']) && $_GET["task"] == "add_grade"){
$course_id =$_GET['course_id'];
$student_id =$_GET['student_id'];
$kind = $_GET['kind'];

if($kind == 'theory'){
	$theory_grade =$_POST['theory_grade'];
	$sqlup = "INSERT INTO grades(grade_id, student_id, course_id, theory_grade)
	VALUES(	gradeID(), '$student_id', '$course_id','$theory_grade')";

mysqli_query($link, $sqlup);

}else if($kind == 'labratory'){
	$labratory_grade =$_POST['labratory_grade'];
	$sqlup = "INSERT INTO grades(grade_id, student_id, course_id, labratory_grade)
	VALUES(	gradeID(), '$student_id', '$course_id', '$labratory_grade')";
	mysqli_query($link, $sqlup);

}else if($kind == 'both'){
	$theory_grade =$_POST['theory_grade'];
	$labratory_grade =$_POST['labratory_grade'];
	$sqlup = "INSERT INTO grades(grade_id, student_id, course_id, theory_grade,
	labratory_grade)
	VALUES(	gradeID(),'$student_id', '$course_id', '$theory_grade', '$labratory_grade')";
	mysqli_query($link, $sqlup);

}
}
?>

<head>
  <meta charset="utf-8">
  <title>Σύστημα Ενημέρωσης Φοιτητών</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../css/style.css  ?v=<?php echo time(); ?>"/>
  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <!-- Vertical Navbar -->
  <div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center">
        <a href="prof_main.php"><img src="../img/logo.png"
          class="mr-3 rounded-circle img-thumbnail shadow-sm" alt="logo" width="80">
        </a>
        <div class="media-body">
          <h3 class="m-0"><?php echo $_SESSION['professor_id']; ?> -
            <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></h3>
          <p class="font-weight-normal text-muted mb-0"><?php echo $_SESSION['description']; ?></p>
        </div>
      </div>
    </div>
    <div class="nav flex-column bg-white">
      <form class="navbar-form form-inline mb-3 search-bar" method="post">
        <div class="form-group">
          <input class="form-control form-control-sm" type="search" placeholder="Αναζήτηση μαθημάτων" aria-label="Search">
          <span class="input-group-btn">
          <button class="btn btn-sm btn-outline" type="submit">
            <i class='bx bx-search'></i>
          </button>
          </span>
        </div>
      </form>
    </div>
    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Μαθήματα</p>

    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="prof_main.php" class="nav-link text-dark ">
          <i class='bx bx-library'></i>
          Τα μαθήματα μου
        </a>
      </li>
      <li class="nav-item">
        <a href="diaxeirisi_mathimaton.php" class="nav-link text-dark">
          <i class='bx bxs-edit'></i>
          Διαχείριση Μαθημάτων
        </a>
      </li>
      <li class="nav-item">
        <a href="vathmologies.php" class="nav-link text-dark">
          <i class='bx bx-book-content'></i>
          Βαθμολογίες
        </a>
      </li>
    </ul>
    <br>
    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Στατιστικά</p>
    <ul class="nav flex-column bg-white mb-0">
      <li>
        <a href="chart_mathimata_prof.php" class="nav-link text-dark">
          <i class='bx bx-poll'></i>
          Μαθήματα
        </a>
      </li>
      <li>
        <a href="charts_foititon_etos.php" class="nav-link text-dark">
          <i class='bx bx-pie-chart-alt-2'></i>
          Φοιτητές / μάθημα / εξάμηνο
        </a>
      </li>
      <li>
        <a href="charts_foititon_mathima.php" class="nav-link text-dark">
          <i class='bx bx-list-ul' ></i>
          Φοιτητές / Μαθήματα
        </a>
      </li>
    </ul>
    <br>
    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Ρυθμίσεις</p>
    <ul class="nav flex-column bg-white mb-0">
      <li>
        <a href="profile.php" class="nav-link text-dark">
          <i class='bx bx-cog'></i>
          Επεξεργασία Προφιλ
        </a>
      </li>
    </ul>
    <ul class="nav flex-column bg-white mb-0">
      <li>
        <a href="logout.php" class="nav-link text-dark bg-gray">
          <i class='bx bx-log-out'></i>
          Αποσύνδεση
        </a>
      </li>
    </ul>
  </div>
  <!-- End of vertical navbar -->

  <!-- Page content -->
  <div class="page-content content-photo p-4" id="content">
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4">
      <i class='bx bx-menu'></i>
    </button>
    <div class="col-lg-12">
      <h3 class="mathimata">Βαθμολογίες Φοιτητών</h3><br>
      <a href="courses_to_add_grade.php" class="btn btn-outline-dark btn-lg">Εισαγωγή νέας βαθμολογίας</a>
      <br />
      <br>
      <table class="table table-light table-bordered table-md table-responsive">
        <thead class="thead-light">
          <tr>
            <th scope="col">ID Βαθμού</th>
            <th scope="col">ID Φοιτητή</th>
            <th scope="col">Φοιτητής</th>
            <th scope="col">Τίτλος Μάθηματος</th>
            <th scope="col">Εξάμηνο</th>
            <th scope="col">Βαθμός Θεωρίας</th>
            <th scope="col">Βαθμός Εργαστηρίου</th>
            <th scope="col">Τελική Βαθμολογία</th>
            <th scope="col">Κατάσταση</th>
            <th scope="col">Επεξεργασία</th>
          </tr>
        </thead>
        <tbody>
          <?php


  			$sql = "SELECT g.grade_id, c.title, s.student_id, s.first_name,  s.last_name , c.semester,
			g.theory_grade, g.labratory_grade, g.final_grade, g.ifFinalized
  			FROM courses c, students s, grades g
  			WHERE c.professor_id = '$professor_id'
						AND g.course_id = c.course_id
  						AND s.student_id = g.student_id";
  $result = $link->query($sql);

  if ($result->num_rows > 0) {
  ?>
   <?php
  while($row = $result->fetch_assoc()){
  	?>
  											<tr>

  												<th scope="row"> <?php echo $row['grade_id']; ?> </th>
  												<th scope="row"> <?php echo $row['student_id']; ?> </th>
  												<th scope="row"> <?php echo $row['first_name'] .  " " . $row['last_name']; ?> </th>
                          <th scope="row"> <?php echo $row['title']; ?> </th>
  												<th scope="row"> <?php echo $row['semester']; ?> </th>
  												<th scope="row"> <?php echo $row['theory_grade']; ?> </th>
  												<th scope="row"> <?php echo $row['labratory_grade']; ?> </th>
  												<th scope="row"> <?php echo $row['final_grade']; ?> </th>
                          <?php if( $row['ifFinalized'] = 1){ ?>
														<th scope="row">Οριστικοποιημένη</th>
                            <th scope="row">
                              <a href="edit_grades.php?grade_id=<?php echo $row['grade_id']; ?>&student_id=<?php echo $row['student_id']; ?>"><i class='bx bxs-edit'></i>Edit</a>
							                <a href="vathmologies.php?grade_id=<?php echo $row['grade_id']; ?>&task=unfinalize">Unfinalize</a>
                						  <a href="vathmologies.php?task=delete&grade_id=<?php echo $row['grade_id']; ?>&student_id=<?php echo $row['student_id']; ?>">Delete</a>
                            </th>
												<?php } else { ?>
  												<th scope="row">Μη Οριστικοποιημένη</th>
                          <th scope="row">
                            <a href="edit_grades.php?grade_id=<?php echo $row['grade_id']; ?> &student_id=<?php echo $row['student_id']; ?>"><i class='bx bxs-edit'></i>Edit</a>

                            <a href="vathmologies.php?grade_id=<?php echo $row['grade_id']; ?> &task=finalize">Finalize</a>

                            <a href="vathmologies.php?task=delete&grade_id=<?php echo $row['grade_id']; ?> &student_id=<?php echo $row['student_id']; ?> ">Delete</a>
                          </th>

												<?php } ?>
                      </tr>
  <?php
    }
    ?>
  <?php
  }else {
    echo "0 results";
  }
  ?>
        </tbody>
      </table>
    </div>

    <!-- Footer  -->
    <div class="page-footer ">
      <div class="container padding">
        <div class="row text-center">
          <div class="col-xs-12 col-sm-12 col-lg-12 footer">
            <a href="http://www.icsd.aegean.gr" target="_blank"> Τμήμα Πληροφοριακών και Επικοινωνιακών Συστημάτων</a>
            <a href="http://www.aegean.gr" target="_blank">| Πανεπιστήμιο Αιγαίου</a>
            <a href="contact_modal" data-toggle="modal" data-target="#contact_modal">| Επικοινωνία </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(function() {
      $('#sidebarCollapse').on('click', function() {
        $('#sidebar,#content').toggleClass('active');
      });
    });
  </script>

  <!-- Contact Modal -->
  <div id="contact_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ContactModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ContactModalTitle">Στοιχεία Επικοινωνίας</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Email : info@gmail.com</p>
          <p>Τηλέφωνο : 22730-12356</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn " data-dismiss="modal">Κλείσιμο</button>
        </div>
      </div>
    </div>
  </div>


</body>

</html>
