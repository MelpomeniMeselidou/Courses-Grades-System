<!DOCTYPE html>
<!-- ΔΕΝ ΧΡΗΣΙΜΟΠΟΙΕΙΤΑΙ -->
<?php  session_start();
$administrator_id = $_SESSION['administrator_id'];
$link= mysqli_connect("localhost","root","","pegasus");
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}

if($_SESSION['role_id']!= 3){
	header("Location: 401.php");
}
?>
<?php
if(isset($_GET['task']) && $_GET["task"] == "edit"){
$course_id_old =$_GET['course_id'];

$course_id =$_POST['InputID'];
$title =$_POST['InputTitle'];
$semester =$_POST['InputSemester'];
$professor_id =$_POST['ProfessorID'];
$theory_grade_percentage =$_POST['InputThGrade'];
$labratory_grade_percentage =$_POST['InputLabGrade'];
$description =$_POST['InputDescription'];

/*
it works propertly but the  foreign key "ccourse_requirements.course_id_chain"  references on courses.course_id is not CONSTRAINT, so we have error. It need to be updated on the database.
$sqlup = "UPDATE courses
        	           SET course_id='$course_id', title='$title', semester='$semester', professor_id = '$professor_id', theory_grade_percentage='$theory_grade_percentage', labratory_grade_percentage='$labratory_grade_percentage', description = '$description'
        	           WHERE course_id='$course_id_old'";
					   */
$sqlup = "UPDATE courses
        	           SET  title='$title', semester='$semester', professor_id = '$professor_id', theory_grade_percentage='$theory_grade_percentage', labratory_grade_percentage='$labratory_grade_percentage', description = '$description'
        	           WHERE course_id='$course_id_old'";
        	 mysqli_query($link, $sqlup);
}
?>

<html lang="el" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Σύστημα Ενημέρωσης Φοιτητών</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <!-- Vertical Navbar -->
  <div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center">
        <img src="../img/logo.png" class="mr-3 rounded-circle img-thumbnail shadow-sm" alt="logo" width="80">
        <div class="media-body">
          <h3 class="m-0"><?php echo $_SESSION['administrator_id']; ?> -
            <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></h3>
          <p class="font-weight-normal text-muted mb-0"><?php echo $_SESSION['description']; ?></p>
        </div>
      </div>
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
        <a href="diaxeirisi_mathimaton_prof.php" class="nav-link text-dark">
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
  <div class="page-content p-4" id="content">
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4">
      <i class='bx bx-menu'></i>
    </button>
    <div class="col-lg-12">
      <h3 id="mathimata">Διαχείριση Μαθημάτων</h3><br>
      <table class="table table-bordered table-md table-responsive-lg">
        <thead class="thead-light">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Τίτλος Μαθήματος</th>
            <th scope="col">Εξάμηνο</th>
            <th scope="col">Ποσοστό Βαθμολογίας Θεωρίας</th>
            <th scope="col">Ποσοστό Βαθμολογίας Εργαστηρίου</th>
            <th scope="col">Διάρκεια Διατήρησης Βαθμολογίας Θεωρίας</th>
            <th scope="col">Διάρκεια Διατήρησης Βαθμολογίας Εργαστηρίου</th>
            <th scope="col">Προαπαιτούμενο Μάθημα</th>
            <th scope="col">Διδάσκον Καθηγητής</th>
            <th scope="col">Περιγραφή</th>
            <th scope="col">Επεξεργασία</th>
            <th scope="col">Λήψη αρχείου</th>
          </tr>
        </thead>
        <tbody>
          <?php
			       $sql = "SELECT c.course_id, c.title, c.semester, c.theory_grade_percentage, c.labratory_grade_percentage, c.ifThGrStays, c.ifLbGrStays, c.description
                    FROM courses c";

                    $result = $link->query($sql);

                    if ($result->num_rows > 0) {
                      ?>

                      <?php
                      while($row = $result->fetch_assoc()){
									$temp_course_id = $row['course_id'];
									$sql_chain = "SELECT cr.course_id_chain 
												FROM course_requirements cr
													WHERE cr.course_id_main = '$temp_course_id' ";

                    $result_chain = $link->query($sql_chain);
									?>
											<tr>
												<th scope="row"> <?php echo $row['course_id']; ?> </th>
												<th scope="row"> <?php echo $row['title']; ?> </th>
												<th scope="row"> <?php echo $row['semester']; ?> </th>
												<th scope="row"> <?php echo $row['theory_grade_percentage']; ?> </th>
												<th scope="row"> <?php echo $row['labratory_grade_percentage']; ?> </th>
												<?php if($row['ifThGrStays'] == -1){ 
												?>
													<th scope="row"> Χωρίς δυνατότητα διατήρησης βαθμού </th>
													<?php 
													} else if($row['ifThGrStays'] == 0) {
														
												?>
													<th scope="row"> Αορίστου χρόνου </th>
												<?php } else if($row['ifThGrStays'] == 1) { ?>
													<th scope="row"> 1 Ακαδημαϊκό έτος </th>
												<?php } else if($row['ifThGrStays'] == 2) {
													?>
													<th scope="row"> 2 Ακαδημαϊκά έτη </th>
												<?php 
													} if($row['ifLbGrStays'] == -1){ 
												?>
													<th scope="row"> Χωρίς δυνατότητα διατήρησης βαθμού </th>
													<?php 
													} else if($row['ifLbGrStays'] == 0) {
														
												?>
													<th scope="row"> Αορίστου χρόνου </th>
												<?php } else if($row['ifLbGrStays'] == 1) { ?>
													<th scope="row"> 1 Ακαδημαϊκό έτος </th>
												<?php } else if($row['ifLbGrStays'] == 2) {
													?>
													<th scope="row"> 2 Ακαδημαϊκά έτη </th>
												<?php } 
													if ($result_chain->num_rows > 0) {
														while($row_course_id_chain = $result_chain->fetch_assoc()){

													 $temp_course_id_chain = $row_course_id_chain['course_id_chain'];
														}
													 $sql_chain2 = "SELECT c.course_id, c.title
																	FROM courses c
																		WHERE c.course_id = '$temp_course_id_chain'";
										
													$result_chain2 = $link->query($sql_chain2);
													if ($result_chain2->num_rows > 0){
														while($row_chain2 = $result_chain2->fetch_assoc()){
														?>
														<th scope="row"> <?php echo $row_chain2['course_id'] . " - " . $row_chain2['title'] ; ?> </th>
														<?php
														}
													}
												 } else {
													 ?>
													 <th scope="row"> - </th>
													 <?php
												 }
													 $temp_prof_course_id = $row['course_id'];
													 $sql_prof = "SELECT p.professor_id, p.first_name, p.last_name
																	FROM professors p, courses c
																		WHERE c.course_id = '$temp_prof_course_id' AND c.professor_id = p.professor_id";

													$result_prof = $link->query($sql_prof);
													if ($result_prof->num_rows > 0){
														while($row_prof = $result_prof->fetch_assoc()){
														?>
													
													<th scope="row"> <?php echo $row_prof['professor_id'] . " - " . $row_prof['first_name'] ." " . $row_prof['last_name']; ?> </th>
													<?php 
														}
													}
													 ?>
												
												
												<th scope="row"> <?php echo $row['description']; ?> </th>
												<th scope="row"> <a href="edit_course_admin.php?course_id=<?php echo $row['course_id']; ?> ">edit</a> </th>
												<th scope="row">
                          <a href="export_grades_to_excel.php?course_id= <?php echo $row['course_id']; ?> "
                          class="btn "  type="submit"
                           name="grades list">Export grades' list</a>
                           <a href="export_students_to_excel.php?course_id= <?php echo $row['course_id']; ?>"
                             class="btn"  type="submit"
                            name="student list">Export students' list</a>
                        </th>
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
