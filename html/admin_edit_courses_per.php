<!DOCTYPE html>
<html lang="el" dir="ltr">

<?php
 session_start();

if($_SESSION['role_id'] == 3){

$link= mysqli_connect("localhost","root","","pegasus");
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
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
  <link rel="stylesheet" type="text/css" href="../css/style.css ?v=<?php echo time(); ?>" />
  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <!-- Vertical Navbar -->
  <div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center">
        <a href="admin_main.php"><img src="../img/logo.png" class="mr-3 rounded-circle img-thumbnail shadow-sm" alt="logo" width="80">
        </a>
        <div class="media-body">
          <h3 class="m-0"><?php echo $_SESSION['administrator_id']; ?> -
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
    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="requests_admin.php" class="nav-link text-dark">
          <i class='bx bx-git-pull-request'></i>
          Αιτήματα
        </a>
      </li>
    </ul>
    <br>
    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Μαθήματα</p>
    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="admin_main.php" class="nav-link text-dark">
          <i class='bx bxs-plus-square'></i>
          Εισαγωγή νέου μαθήματος
        </a>
      </li>
      <li class="nav-item">
        <a href="diaxeirisi_mathimaton_admin.php" class="nav-link text-dark ">
          <i class='bx bx-library'></i>
          Διαχείριση Μαθημάτων
        </a>
      </li>
      <li class="nav-item">
        <a href="dilosis_foititon_admin.php" class="nav-link text-dark">
          <i class='bx bx-library'></i>
          Δηλώσεις Μαθημάτων Φοιτητών
        </a>
      </li>
      <li class="nav-item">
        <a href="diaxeirisi_vathmologiwn_admin.php" class="nav-link text-dark">
          <i class='bx bx-library'></i>
          Διαχείριση Βαθμολογιών
        </a>
      </li>
    </ul>
    <br>
    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Στατιστικά</p>
    <ul class="nav flex-column bg-white mb-0">
      <li>
        <a href="#" class="nav-link text-dark">
          <i class='bx bx-poll'></i>
          Ποσοστά Φοιτητών
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-dark">
          <i class='bx bx-poll'></i>
          Ποσοστά Καθηγητών
        </a>
      </li>
    </ul>
    <br />
    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Διαχείριση Χρηστών</p>
    <ul class="nav flex-column bg-white mb-0">
      <li>
        <a href="diaxeirisi_foititon.php" class="nav-link text-dark">
          <i class='bx bx-library'></i>
          Διαχείριση Φοιτητών
        </a>
      </li>
      <li>
        <a href="diaxeirisi_kathigiton.php" class="nav-link text-dark">
          <i class='bx bx-library'></i>
          Διαχείριση Καθηγητών
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
    <div class="container-fluid">
      <div class="col-lg-12">
        <h3 class="mathimata">Διαχείρηση Βαθμολογιών Φοιτητών</h3><br>
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active " data-toggle="tab" href="#ana_kathigith">Μαθήματα ανά Καθηγητή</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#ana_mathima">Μαθήματα</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#ana_foitith">Φοιτητές</a>
          </li>
        </ul>
        <div class="tab-content">
          <!-- First TAB -->
          <div id="ana_kathigith" class="tab-pane fade show active">
            <br>
            <h3 id="mathimata">Προσθήκη Βαθμολογιών ανά Μάθημα Καθηγητή</h3><br>
            <?php
      $sql = "SELECT p.professor_id, p.first_name, p.last_name, p.email, p.vathmida
      FROM professors p";
      $result0 = $link->query($sql);
      if ($result0->num_rows > 0) {
      ?>
            <?php
      while($row0 = $result0->fetch_assoc()){
        ?>

            <h3 id="mathimata"><?php echo $row0['professor_id'] . " - " . $row0['first_name']  . " " . $row0['last_name'] ; ?></h3><br>
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
                </tr>
              </thead>
              <tbody>
                <?php
		  $prof_id = $row0['professor_id'];
			       $sql = "SELECT c.course_id, c.title, c.semester, c.theory_grade_percentage, c.labratory_grade_percentage, c.ifThGrStays, c.ifLbGrStays, c.description
                    FROM courses c, professors p WHERE c.professor_id = '$prof_id' AND c.professor_id = p.professor_id";
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
                  <th scope="row"> <a href="students_to_add_grade.php?course_id=<?php echo $row['course_id']; ?> ">add grade</a> </th>
                </tr>
                <?php
                        }
                        ?>
              </tbody>
            </table>
            <?php
                  }else {
                    echo "0 results";
					}}} ?>

            <!-- End of First TAB  -->
          </div>
          <div id="ana_mathima" class="tab-pane fade">
            <br>
            <p>Φοιτητές που έχουν ήδη βαθμολογία στο μάθημα</p>
            <table class="table table-light table-bordered table-md table-responsive">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID Μαθήματος</th>
                  <th scope="col">Τίτλος</th>
                  <th scope="col">Εξάμηνο</th>

                  <th scope="col">Καθηγητης</th>
                  <th scope="col">Ποσοστό Βαθμού Θεωρίας</th>
                  <th scope="col">Ποσοστό Βαθμού Εργαστηρίου</th>
                  <th scope="col">Διατήρηση Βαθμολογίας Θεωρίας</th>
                  <th scope="col">Διατήρηση Βαθμολογίας Εργαστηρίου</th>
                  <th scope="col">Περιγραφή</th>
                  <th scope="col">Επεξεργασία</th>
                </tr>
              </thead>
              <tbody>
                <?php
        				//Begining of Second TAB
        				//Query for the SECOND TAB
        			  $sql2 =  $sql = "SELECT c.course_id, c.title, c.semester, p.first_name, p.last_name, c.theory_grade_percentage, c.labratory_grade_percentage, c.ifThGrStays, c.ifLbGrStays, c.description
                      FROM courses c, professors p WHERE c.professor_id = p.professor_id";

                $result2 = $link->query($sql2);
                if ($result2->num_rows > 0) {
                  while($row2 = $result2->fetch_assoc()){
                    ?>

                <tr>
                  <th scope="row"> <?php echo $row2['course_id']; ?> </th>
                  <th scope="row"> <?php echo $row2['title']; ?> </th>
                  <th scope="row"> <?php echo $row2['semester']; ?> </th>
                  <th scope="row"> <?php echo $row2['first_name'] . "-" . $row2['last_name']; ?> </th>
                  <th scope="row"> <?php echo $row2['theory_grade_percentage']; ?> </th>
                  <th scope="row"> <?php echo $row2['labratory_grade_percentage']; ?> </th>
                  <?php if($row2['ifThGrStays'] == -1){
  												?>
                  <th scope="row"> Χωρίς δυνατότητα διατήρησης βαθμού </th>
                  <?php
  													} else if($row2['ifThGrStays'] == 0) {

  												?>
                  <th scope="row"> Αορίστου χρόνου </th>
                  <?php } else if($row2['ifThGrStays'] == 1) { ?>
                  <th scope="row"> 1 Ακαδημαϊκό έτος </th>
                  <?php } else if($row2['ifThGrStays'] == 2) {
  													?>
                  <th scope="row"> 2 Ακαδημαϊκά έτη </th>
                  <?php
  													} if($row2['ifLbGrStays'] == -1){
  												?>
                  <th scope="row"> Χωρίς δυνατότητα διατήρησης βαθμού </th>
                  <?php
  													} else if($row2['ifLbGrStays'] == 0) {

  												?>
                  <th scope="row"> Αορίστου χρόνου </th>
                  <?php } else if($row2['ifLbGrStays'] == 1) { ?>
                  <th scope="row"> 1 Ακαδημαϊκό έτος </th>
                  <?php } else if($row2['ifLbGrStays'] == 2) {
  													?>
                  <th scope="row"> 2 Ακαδημαϊκά έτη </th>
                  <?php } ?>
                  <th scope="row"> <?php echo $row2['description']; ?> </th>
                  <th scope="row">
                    <a href="add_grade.php?course_id=<?php echo $row2['course_id']; ?>&task=theory"><i class='bx bxs-edit'></i>Students</a>
                    <a href="add_grade.php?course_id=<?php echo $row2['course_id']; ?>&task=theory"><i class='bx bxs-edit'></i>Add theory grade</a>
                    <a href="add_grade.php?course_id=<?php echo $row2['course_id']; ?>&task=labratory"><i class='bx bxs-edit'></i>Add labratory grade</a>
                    <br>
                    <a href="add_grade.php?course_id=<?php echo $row2['course_id']; ?>&task=both"><i class='bx bxs-edit'></i>Add theory & labratory grade</a>
                  </th>
                </tr>
                <?php
                  } ?>
              </tbody>
            </table>

            <?php }else {
                  echo "0 results";
                }
                ?>

          </div>
          <div id="ana_foitith" class="tab-pane fade">

            <?php
             				//Begining of Third TAB
             				//Query for the Third TAB
             			  $sql3 =   "SELECT s.student_id, s.first_name, s.last_name, s.email
                           FROM students s";

                     $result3 = $link->query($sql3);
                     if ($result3->num_rows > 0) {
                       while($row3 = $result3->fetch_assoc()){
                         ?>
            <p><?php echo $row3['student_id'] . " - " . $row3['first_name'] . " ". $row3['last_name']; ?></p><br>
            <table class="table table-bordered table-md table-responsive-lg">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID Βαθμού</th>
                  <th scope="col">ID Μαθήματος</th>
                  <th scope="col">Τίτλος</th>
                  <th scope="col">Εξάμηνο</th>
                  <th scope="col">Βαθμός Θεωρίας</th>
                  <th scope="col">Βαθμός Εργαστηρίου</th>
                  <th scope="col">Τελικός Βαθμός</th>
                  <th scope="col">Κατάσταση</th>
                  <th scope="col">Επεξεργασία Βαθμού</th>
                </tr>
              </thead>
              <tbody>
                <?php
             				//Begining of Second TAB
             				//Query for the SECOND TAB
       					$stud_id = $row3['student_id'];
             			  $sql4 = "SELECT g.grade_id, c.course_id, c.title, c.semester, g.theory_grade, g.labratory_grade, g.final_grade, g.ifFinalized
                               FROM grades g, students s, courses c
             			             WHERE g.student_id = '$stud_id' AND g.student_id = s.student_id
       										AND g.course_id = c.course_id";

                     $result4 = $link->query($sql4);
                     if ($result4->num_rows > 0) {
                       while($row4 = $result4->fetch_assoc()){
       					$cour_id = $row4['course_id'];
                         ?>
                <tr>
                  <th scope="row"> <?php echo $row4['grade_id']; ?> </th>
                  <th scope="row"> <?php echo $row4['course_id']; ?> </th>
                  <th scope="row"> <?php echo $row4['title']; ?> </th>
                  <th scope="row"> <?php echo $row4['semester']; ?> </th>
                  <th scope="row"> <?php echo $row4['theory_grade']; ?> </th>
                  <th scope="row"> <?php echo $row4['labratory_grade']; ?> </th>
                  <th scope="row"> <?php echo $row4['final_grade']; ?> </th>
                  <?php if($row4['ifFinalized'] == 1){
       												?>
                  <th scope="row"> Οριστικοποιημένη </th>
                  <?php
       													} else if($row4['ifThGrStays'] == 0) { ?>
                  <th scope="row">Μη Οριστικοποιημένη </th>
                  <?php }?>
                  <th scope="row">
                    <a href="add_grade.php?course_id=<?php echo $cour_id; ?>&student_id=<?php echo $stud_id; ?>&task=theory"><i class='bx bxs-edit'></i>Add theory grade</a>
                    <a href="add_grade.php?course_id=<?php echo $cour_id; ?>&student_id=<?php echo $stud_id['student_id']; ?>&task=labratory"><i class='bx bxs-edit'></i>Add labratory grade</a>
                    <a href="add_grade.php?course_id=<?php echo $cour_id; ?>&student_id=<?php echo $stud_id['student_id']; ?>&task=both"><i class='bx bxs-edit'></i>Add theory & labratory grade</a>
                  </th>
                </tr>

                <?php
                       }
                     }else {
                       echo "0 results";
                     } ?>
              </tbody>
            </table>




            <?php
       					  }
       					}
                             ?>

          </div>
          <!-- END of Second Tab  -->
        </div>
      </div>
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
