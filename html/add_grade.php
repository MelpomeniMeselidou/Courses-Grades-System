<!DOCTYPE html>
<html lang="el" dir="ltr">

<?php
session_start();

$course_id = $_GET['course_id'];
$student_id = $_GET['student_id'];

if(isset($_GET['task']) && $_GET["task"] == "theory"){
$task ='theory';
}
else if(isset($_GET['task']) && $_GET["task"] == "labratory"){
$task ='labratory';
}
else if(isset($_GET['task']) && $_GET["task"] == "both"){
$task ='both';

}
?>

<head>

  <meta charset="utf-8">
  <title>Σύστημα Ενημέρωσης Φοιτητών</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
          <h3 class="m-0"><?php echo $_SESSION['professor_id']; ?> -
            <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?> </h3>
          <p class="font-weight-normal text-muted mb-0"><?php echo $_SESSION['professor_id']; ?> -
            <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?> </p>
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
          <i class='bx bx-poll'></i>
          Φοιτητές / μάθημα / εξάμηνο
        </a>
      </li>
      <li>
        <a href="charts_foititon_mathima.php" class="nav-link text-dark">
          <i class='bx bx-poll'></i>
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
	<?php
		if($task == 'theory'){ ?>
			<h3 id="mathimata">Προσθήκη Βαθμολογίας Θεωρίας</h3><br>
		<?php }
		else if($task == 'labratory'){ ?>
			<h3 id="mathimata">Προσθήκη Βαθμολογίας Εργαστηρίου</h3><br>
		<?php }

		else if($task == 'both'){ ?>
			<h3 id="mathimata">Προσθήκη Βαθμολογίας Θεωρίας και Εργαστηρίου</h3><br>
		<?php } ?>

      <form action="vathmologies.php?task=add_grade&kind=<?php echo $task;?>&course_id=<?php echo $course_id;?>&student_id=<?php echo $student_id;?>" method="post">
	<?php
	$link= mysqli_connect("localhost","root","","pegasus");
	$sql0 = "SELECT s.student_id, s.first_name, s.last_name, s.email, cs.statement_semester, c.title
                    FROM students s, courses c, course_statements cs
					WHERE s.student_id = '$student_id' AND c.course_id = '$course_id'
						AND cs.course_id = c.course_id AND cs.student_id = s.student_id";
        $result0 = $link->query($sql0);

if ($result0->num_rows > 0) {

while($row = $result0->fetch_assoc()){
	?>
	 <div class="form-group row">
          <label class="col-2 col-form-label" for="InputID">ID Μαθήματος: </label>
          <input readonly type="text" class="col-4 form-control" id="InputID" value="<?php echo $course_id;?>">
        </div>
        <div class="form-group row">
          <label class="col-2 col-form-label" for="InputTitle">ID Φοιτητή: </label>
          <input readonly type="text" class="col-4 form-control" id="InputTitle" value="<?php echo $student_id;?>">
        </div>
		<div class="form-group row">
          <label class="col-2 col-form-label" for="InputTitle">Φοιτητής: </label>
          <input readonly type="text" class="col-4 form-control" id="InputTitle" value=" <?php echo $row['first_name'] .  " " . $row['last_name']; ?> ">
        </div><div class="form-group row">
          <label class="col-2 col-form-label" for="InputTitle">Τίτλος Μαθήματος: </label>
          <input readonly type="text" class="col-4 form-control" id="InputTitle" value="<?php echo $row['title']; ?> ">
        </div>
        <div class="form-group row">
          <label class="col-2 col-form-label" for="InputSemester">Τρέχον Εξάμηνο: </label>
          <input readonly type="text" class="col-4 form-control" id="InputSemester" value=" <?php echo $row['statement_semester'];?>">
        </div>
        <?php
			} }

$link= mysqli_connect("localhost","root","","pegasus");

  			// $sql = "SELECT s.student_id, s.first_name, s.last_name, s.email, cs.statement_semester, c.title, g.theory_grade, g.labratory_grade
                    // FROM students s, course_statements cs, courses c, grades g
			              // WHERE s.student_id '$student_id'
							// And s.student_id = cs.student_id
							// AND cs.ifFinalized = 1
							// AND cs.course_id = '$course_id'
							// AND c.course_id = '$course_id'
							// AND (g.course_id = '$course_id' AND g.student_id = '$student_id')";
		// $sql = "SELECT s.student_id, s.first_name, s.last_name, s.email, cs.statement_semester, c.title, g.theory_grade, g.labratory_grade
                    // FROM students s, course_statements cs, courses c, grades g
					// WHERE s.student_id = '$student_id' AND c.course_id = '$course_id'
						// AND g.student_id = s.student_id AND g.course_id = c.course_id ";
		$sql = "SELECT g.theory_grade, g.labratory_grade
                    FROM grades g
					WHERE  g.student_id = '$student_id' AND g.course_id = '$course_id' ";
        $result = $link->query($sql);

if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()){
	?>

		<?php
		if($task == 'theory'){ ?>
        <div class="form-group row">
          <label class="col-2 col-form-label" for="theory_grade">Βαθμός Θεωρίας: </label>
          <input type="text" class="col-4 form-control" id="theory_grade" name="theory_grade" placeholder = " <?php echo $row['theory_grade'];?>"	>
        </div>
		<div class="form-group row">
          <label class="col-2 col-form-label" for="labratory_grade">Βαθμός Εργαστηρίου: </label>
          <input readonly type="text" class="col-4 form-control" id="labratory_grade" value=" <?php echo $row['labratory_grade'];?>">
        </div>
		<?php
		} else if($task == 'labratory'){ ?>
		<div class="form-group row">
          <label class="col-2 col-form-label" for="theory_grade">Βαθμός Θεωρίας: </label>
          <input readonly type="text" class="col-4 form-control" id="theory_grade" value=" <?php echo $row['theory_grade'];?>">
        </div>
        <div class="form-group row">
          <label class="col-2 col-form-label" for="labratory_grade">Βαθμός Εργαστηρίου: </label>
          <input type="text" class="col-4 form-control" id="labratory_grade" name="labratory_grade" placeholder = " <?php echo $row['labratory_grade'];?>">
        </div>
		<?php
		} else if($task == 'both') { ?>
		<div class="form-group row">
          <label class="col-2 col-form-label" for="theory_grade">Βαθμός Θεωρίας: </label>
          <input type="text" class="col-4 form-control" id="theory_grade" name="theory_grade" placeholder = " <?php echo $row['theory_grade'];?>"	>
        </div>
		<div class="form-group row">
          <label class="col-2 col-form-label" for="labratory_grade">Βαθμός Εργαστηρίου: </label>
          <input type="text" class="col-4 form-control" id="labratory_grade" name="labratory_grade" placeholder = " <?php echo $row['labratory_grade'];?>">
        </div>
		<?php } ?>
        <br />
        <div class="form-group">
          <button type="submit" class="btn" name="button">Αποθήκευση Αλλαγών</button>
        </div>
        <br>
      <?php }
	  } else {

		  if($task == 'theory'){ ?>
        <div class="form-group row">
          <label class="col-2 col-form-label" for="theory_grade">Βαθμός Θεωρίας: </label>
          <input type="text" class="col-4 form-control" id="theory_grade" name="theory_grade" placeholder = "Enter theory grade"	>
        </div>
		<div class="form-group row">
          <label class="col-2 col-form-label" for="labratory_grade">Βαθμός Εργαστηρίου: </label>
          <input readonly type="text" class="col-4 form-control" id="labratory_grade" value="-">
        </div>
		<?php
		} else if($task == 'labratory'){ ?>
		<div class="form-group row">
          <label class="col-2 col-form-label" for="theory_grade">Βαθμός Θεωρίας: </label>
          <input readonly type="text" class="col-4 form-control" id="theory_grade" value="-">
        </div>
        <div class="form-group row">
          <label class="col-2 col-form-label" for="labratory_grade">Βαθμός Εργαστηρίου: </label>
          <input type="text" class="col-4 form-control" id="labratory_grade" name="labratory_grade" placeholder = "Enter labratory grade">
        </div>
		<?php
		} else if($task == 'both') { ?>
		<div class="form-group row">
          <label class="col-2 col-form-label" for="theory_grade">Βαθμός Θεωρίας: </label>
          <input type="text" class="col-4 form-control" id="theory_grade" name="theory_grade" placeholder = "Enter theory grade"	>
        </div>
		<div class="form-group row">
          <label class="col-2 col-form-label" for="labratory_grade">Βαθμός Εργαστηρίου: </label>
          <input type="text" class="col-4 form-control" id="labratory_grade" name="labratory_grade" placeholder = "Enter labratory grade">
        </div>
	  <?php } } ?>
        <br />
        <div class="form-group">
          <button type="submit" class="btn" name="button">Αποθήκευση Αλλαγών</button>
        </div>
        <br>

      </form>
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
