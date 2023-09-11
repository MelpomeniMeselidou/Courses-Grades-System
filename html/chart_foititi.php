<!DOCTYPE html>

<?php  session_start();

$student_id = $_SESSION['student_id'];
$link= mysqli_connect("localhost","root","","pegasus");
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
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
  <link rel="stylesheet" type="text/css" href="../css/style.css  ?v=<?php echo time(); ?>" >
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <!-- Vertical Navbar -->
  <div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center">
        <a href="student_main.php"><img src="../img/logo.png"
          class="mr-3 rounded-circle img-thumbnail shadow-sm" alt="logo" width="80">
        </a>
        <div class="media-body">
          <h3 class="m-0"> <?php echo $_SESSION['student_id']; ?> -
            <?php echo $_SESSION['first_name'];?> <?php echo $_SESSION['last_name']; ?> </h3>
          <p class="font-weight-normal text-muted mb-0"> <?php echo $_SESSION['description']; ?> </p>
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
        <a href="student_main.php" class="nav-link text-dark ">
          <i class='bx bx-library'></i>
          Τα μαθήματα μου
        </a>
      </li>
      <li class="nav-item">
        <a href="perasmena.php" class="nav-link text-dark">
          <i class='bx bx-check'></i>
          Επιτυχή μαθήματα
        </a>
      </li>
      <li class="nav-item">
        <a href="nea_dilosi.php" class="nav-link text-dark">
          <i class='bx bxs-plus-square'></i>
          Νέα δήλωση μαθημάτων
        </a>
      </li>
    </ul>
    <br>
    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Στατιστικά</p>
    <ul class="nav flex-column bg-white mb-0">
      <li>
        <a href="chart_foititi.php" class="nav-link text-dark">
          <i class='bx bx-poll'></i>
          Ποσοστά μαθημάτων
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
        <a href="index.php" class="nav-link text-dark bg-gray">
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
    <h3 class="mathimata">Στατιστικά</h3><br>
      <div class="container-fluid">
        <div class="col-lg-12">
        <h4>Επιτυχή μαθήματα</h4><br>
        <table class="table table-light table-bordered table-md table-responsive-lg">
          <thead class="thead-light">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Τίτλος Μαθήματος</th>
              <th scope="col">Διδάσκον/ουσα</th>
              <th scope="col">Εξάμηνο</th>
              <th scope="col">Βαθμός Θεωρίας</th>
              <th scope="col">Βαθμός Εργαστηρίου</th>
              <th scope="col">Τελική Βαθμολογία</th>
            </tr>
          </thead>
          <tbody>

          <?php
          $sql = "SELECT c.course_id, c.title, p.first_name,  p.last_name , c.semester, g.theory_grade, g.labratory_grade, g.final_grade
          FROM courses c, students s, professors p, passed_courses pc, grades g
          WHERE pc.student_id = '$student_id'
                AND s.student_id = pc.student_id
                AND pc.course_id = c.course_id
                AND p.professor_id = c.professor_id
                AND g.student_id = pc.student_id
                AND g.course_id = pc.course_id
                AND g.ifFinalized = 1";

          $result = $link->query($sql);
          if ($result->num_rows > 0) {
          ?>
          <?php
          while($row = $result->fetch_assoc()){
            ?>

          <tr>
          <th scope="row"> <?php echo $row['course_id']; ?> </th>
          <th scope="row"> <?php echo $row['title']; ?> </th>
          <th scope="row"> <?php echo $row['first_name'] .  " " . $row['last_name']; ?> </th>
          <th scope="row"> <?php echo $row['semester']; ?> </th>
          <th scope="row"> <?php echo $row['theory_grade']; ?> </th>
          <th scope="row"> <?php echo $row['labratory_grade']; ?> </th>
          <th scope="row"> <?php echo $row['final_grade']; ?> </th>
          </tr>

          <?php }
          ?>
          <?php
          }else {
            echo "0 results";
          }
          ?>
        </tbody>
        </table>
        </div>
        <div class="col-lg-12">
          <br>
          <h5>Γραφήματα ανά έτος και εξάμηνο: </h5>
          <br>
          <div class="row year_tabs">
            <ul class="nav nav-tabs justify-content-center">
              <li class="nav-item">
                <a class="nav-link active "data-toggle="tab" href="#etos1">1ο έτος</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#etos2">2ο έτος</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#etos3">3ο έτος</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#etos4">4ο έτος</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#etos5">5ο έτος</a>
              </li>
            </ul>
          </div>
          <div class="container tab-content">
            <div id="etos1" class="tab-pane fade show active">
              <div class="row">
                <!-- 1ο Εξάμηνο -->
                <div class="col-lg-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class='bx bx-pie-chart-alt-2'></i>
                      1ο εξάμηνο
                    </div>
                    <div class="card-body">
                      <canvas id="myChart1" width="300" height="300"></canvas>
                    </div>
                  </div>
                </div>
                <!-- 2ο Εξάμηνο -->
                <div class="col-lg-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class='bx bx-pie-chart-alt-2'></i>
                      2ο εξάμηνο
                    </div>
                    <div class="card-body">
                      <canvas id="myChart2" width="300" height="300"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="etos2" class="tab-pane fade">
              <div class="row">
                <!-- 3ο Εξάμηνο -->
                <div class="col-lg-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class='bx bx-pie-chart-alt-2'></i>
                      3ο εξάμηνο
                    </div>
                    <div class="card-body">
                      <canvas id="myChart3" width="300" height="300"></canvas>
                    </div>
                  </div>
                </div>
                <!-- 4ο Εξάμηνο -->
                <div class="col-lg-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class='bx bx-pie-chart-alt-2'></i>
                      4ο εξάμηνο
                    </div>
                    <div class="card-body">
                      <canvas id="myChart4" width="300" height="300"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="etos3" class="tab-pane fade">
              <div class="row">
                <!-- 5ο Εξάμηνο -->
                <div class="col-lg-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class='bx bx-pie-chart-alt-2'></i>
                      5ο εξάμηνο
                    </div>
                    <div class="card-body">
                      <canvas id="myChart5" width="300" height="300"></canvas>
                    </div>
                  </div>
                </div>
                <!-- 6ο Εξάμηνο -->
                <div class="col-lg-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class='bx bx-pie-chart-alt-2'></i>
                      6ο εξάμηνο
                    </div>
                    <div class="card-body">
                      <canvas id="myChart6" width="300" height="300"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="etos4" class="tab-pane fade">
              <div class="row">
                <!-- 7ο Εξάμηνο -->
                <div class="col-lg-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class='bx bx-pie-chart-alt-2'></i>
                      7ο εξάμηνο
                    </div>
                    <div class="card-body">
                      <canvas id="myChart7" width="300" height="300"></canvas>
                    </div>
                  </div>
                </div>
                <!-- 8ο Εξάμηνο -->
                <div class="col-lg-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class='bx bx-pie-chart-alt-2'></i>
                      8ο εξάμηνο
                    </div>
                    <div class="card-body">
                      <canvas id="myChart8" width="300" height="300"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="etos5" class="tab-pane fade">
              <div class="row">
                <!-- 9ο Εξάμηνο -->
                <div class="col-lg-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class='bx bx-pie-chart-alt-2'></i>
                      9ο εξάμηνο
                    </div>
                    <div class="card-body">
                      <canvas id="myChart9" width="300" height="300"></canvas>
                    </div>
                  </div>
                </div>
                <!-- 10ο Εξάμηνο -->
                <div class="col-lg-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <i class='bx bx-pie-chart-alt-2'></i>
                      10ο εξάμηνο
                    </div>
                    <div class="card-body">
                      <canvas id="myChart10" width="300" height="300"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
    <!-- sidebar script -->
    <script type="text/javascript">
    $(function() {
      $('#sidebarCollapse').on('click', function() {
        $('#sidebar,#content').toggleClass('active');
      });
    });
    </script>

  <!-- Chart Scripts -->
    <?php
		  $sql = " SELECT COUNT(*) FROM courses c WHERE c.semester = 1";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester1sum = $row['COUNT(*)'];
		}}
	   ?>
	 <?php
		  $sql = " SELECT COUNT(*) FROM courses c, passed_courses pc
		  WHERE pc.student_id = '$student_id'
					AND c.semester = 1
					AND pc.course_id = c.course_id ";
		  $result = $link->query($sql);
		    if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()){
			$semester1passed = $row['COUNT(*)'];
      }}
		  $failed1 = $semester1sum - $semester1passed;
		    $passed1 = $semester1sum - $failed1;
	  ?>

	<script type="text/javascript">
    var failed1 = <?php Print($failed1); ?>;
    var passed1 = <?php Print($passed1); ?>;
  </script>

    <?php
		  $sql = " SELECT COUNT(*) FROM courses c WHERE c.semester = 2";
		  $result = $link->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
          $semester2sum = $row['COUNT(*)'];
        }}
    ?>
	  <?php
		  $sql = " SELECT COUNT(*) FROM courses c, passed_courses pc
      WHERE pc.student_id = '$student_id'
					AND c.semester = 2
					AND pc.course_id = c.course_id ";

		  $result = $link->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
          $semester2passed = $row['COUNT(*)'];
        }}
        $failed2 = $semester1sum - $semester1passed;
        $passed2 = $semester1sum - $failed2;
    ?>

	<script type="text/javascript">
    var failed2 = <?php Print($failed2); ?>;
    var passed2 = <?php Print($passed2); ?>;
  </script>

    <?php
		  $sql = " SELECT COUNT(*) FROM courses c WHERE c.semester = 3";
		  $result = $link->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
          $semester3sum = $row['COUNT(*)'];
        }}
      ?>
	 <?php
		  $sql = " SELECT COUNT(*) FROM courses c, passed_courses pc
		  WHERE pc.student_id = '$student_id'
					AND c.semester = 3
					AND pc.course_id = c.course_id ";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester3passed = $row['COUNT(*)'];
		}}
		$failed3 = $semester3sum - $semester3passed;
		$passed3 = $semester3sum - $failed3;
	?>
	<script type="text/javascript">
    var failed3 = <?php Print($failed3); ?>;
    var passed3 = <?php Print($passed3); ?>;
</script>

    <?php
		  $sql = " SELECT COUNT(*) FROM courses c WHERE c.semester = 4";
		  $result = $link->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
          $semester4sum = $row['COUNT(*)'];
        }}
        ?>
    <?php
		  $sql = " SELECT COUNT(*) FROM courses c, passed_courses pc
		  WHERE pc.student_id = '$student_id'
					AND c.semester = 4
					AND pc.course_id = c.course_id ";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester4passed = $row['COUNT(*)'];
		}}
		$failed4 = $semester4sum - $semester4passed;
		$passed4 = $semester4sum - $failed4;
	?>
	<script type="text/javascript">
    var failed4 = <?php Print($failed4); ?>;
    var passed4 = <?php Print($passed4); ?>;
</script>


    <?php
		  $sql = " SELECT COUNT(*) FROM courses c WHERE c.semester = 5";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester5sum = $row['COUNT(*)'];
		}}
	?>
	 <?php
		  $sql = " SELECT COUNT(*) FROM courses c, passed_courses pc
		  WHERE pc.student_id = '$student_id'
					AND c.semester = 5
					AND pc.course_id = c.course_id ";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester5passed = $row['COUNT(*)'];
		}}
		$failed5 = $semester5sum - $semester5passed;
		$passed5 = $semester5sum - $failed5;
	?>
	<script type="text/javascript">
    var failed5 = <?php Print($failed5); ?>;
    var passed5 = <?php Print($passed5); ?>;
</script>



    <?php
		  $sql = " SELECT COUNT(*) FROM courses c WHERE c.semester = 6";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester6sum = $row['COUNT(*)'];
		}}
	?>
	 <?php
		  $sql = " SELECT COUNT(*) FROM courses c, passed_courses pc
		  WHERE pc.student_id = '$student_id'
					AND c.semester = 6
					AND pc.course_id = c.course_id ";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester6passed = $row['COUNT(*)'];
		}}
		$failed6 = $semester6sum - $semester6passed;
		$passed6 = $semester6sum - $failed6;
	?>
	<script type="text/javascript">
    var failed6 = <?php Print($failed6); ?>;
    var passed6 = <?php Print($passed6); ?>;
</script>



    <?php
		  $sql = " SELECT COUNT(*) FROM courses c WHERE c.semester = 7";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester7sum = $row['COUNT(*)'];
		}}
	?>
	 <?php
		  $sql = " SELECT COUNT(*) FROM courses c, passed_courses pc
		  WHERE pc.student_id = '$student_id'
					AND c.semester = 7
					AND pc.course_id = c.course_id ";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester7passed = $row['COUNT(*)'];
		}}
		$failed7 = $semester7sum - $semester7passed;
		$passed7 = $semester7sum - $failed7;
	?>
	<script type="text/javascript">
    var failed7 = <?php Print($failed7); ?>;
    var passed7 = <?php Print($passed7); ?>;
</script>



    <?php
		  $sql = " SELECT COUNT(*) FROM courses c WHERE c.semester = 8";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester8sum = $row['COUNT(*)'];
		}}
	?>
	 <?php
		  $sql = " SELECT COUNT(*) FROM courses c, passed_courses pc
		  WHERE pc.student_id = '$student_id'
					AND c.semester = 8
					AND pc.course_id = c.course_id ";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester8passed = $row['COUNT(*)'];
		}}
		$failed8 = $semester8sum - $semester8passed;
		$passed8 = $semester8sum - $failed8;
	?>
	<script type="text/javascript">
    var failed8 = <?php Print($failed8); ?>;
    var passed8 = <?php Print($passed8); ?>;
</script>


    <?php
		  $sql = " SELECT COUNT(*) FROM courses c WHERE c.semester = 9";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester9sum = $row['COUNT(*)'];
		}}
	?>
	 <?php
		  $sql = " SELECT COUNT(*) FROM courses c, passed_courses pc
		  WHERE pc.student_id = '$student_id'
					AND c.semester = 9
					AND pc.course_id = c.course_id ";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester9passed = $row['COUNT(*)'];
		}}
		$failed9 = $semester9sum - $semester9passed;
		$passed9 = $semester9sum - $failed9;
	?>
	<script type="text/javascript">
    var failed9 = <?php Print($failed9); ?>;
    var passed9 = <?php Print($passed9); ?>;
</script>

    <?php
		  $sql = " SELECT COUNT(*) FROM courses c WHERE c.semester = 10";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester10sum = $row['COUNT(*)'];
		}}
	?>
	 <?php
		  $sql = " SELECT COUNT(*) FROM courses c, passed_courses pc
		  WHERE pc.student_id = '$student_id'
					AND c.semester = 10
					AND pc.course_id = c.course_id ";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$semester10passed = $row['COUNT(*)'];
		}}
		$failed10 = $semester10sum - $semester10passed;
		$passed10 = $semester10sum - $failed10;
	?>
	<script type="text/javascript">
    var failed10 = <?php Print($failed10); ?>;
    var passed10 = <?php Print($passed10); ?>;
</script>


  <script type="text/javascript">

    // 1o εξάμηνο
    let myChart1 = document.getElementById("myChart1").getContext('2d');
    let chart1 = new Chart(myChart1, {
      type: 'pie',
      data: {
        labels: ['Επιτυχία', 'Αποτυχία'],
        datasets: [{
          data: [passed1,failed1],
          backgroundColor: ['#76a371', '#a37771']
        }]
      },
      options: {
        title: {
          text: "1ο εξάμηνο",
          display: true
        }
      }
    });
    // 2o εξάμηνο
    let myChart2 = document.getElementById("myChart2").getContext('2d');
    let chart2 = new Chart(myChart2, {
      type: 'pie',
      data: {
        labels: ['Επιτυχία', 'Αποτυχία'],
        datasets: [{
          data: [passed2, failed2],
          backgroundColor: ['#76a371', '#a37771']
        }]
      },
      options: {
        title: {
          text: "2ο εξάμηνο",
          display: true
        }
      }
    });
    // 3o εξάμηνο
    let myChart3 = document.getElementById("myChart3").getContext('2d');
    let chart3 = new Chart(myChart3, {
      type: 'pie',
      data: {
        labels: ['Επιτυχία', 'Αποτυχία'],
        datasets: [{
          data: [passed3, failed3],
          backgroundColor: ['#76a371', '#a37771']
        }]
      },
      options: {
        title: {
          text: "3ο εξάμηνο",
          display: true
        }
      }
    });
    // 4o εξάμηνο
    let myChart4 = document.getElementById("myChart4").getContext('2d');
    let chart4 = new Chart(myChart4, {
      type: 'pie',
      data: {
        labels: ['Επιτυχία', 'Αποτυχία'],
        datasets: [{
          data: [passed4, failed4],
          backgroundColor: ['#76a371', '#a37771']
        }]
      },
      options: {
        title: {
          text: "4ο εξάμηνο",
          display: true
        }
      }
    });
    // 5o εξάμηνο
    let myChart5 = document.getElementById("myChart5").getContext('2d');
    let chart5 = new Chart(myChart5, {
      type: 'pie',
      data: {
        labels: ['Επιτυχία', 'Αποτυχία'],
        datasets: [{
          data: [passed5, failed5],
          backgroundColor: ['#76a371', '#a37771']
        }]
      },
      options: {
        title: {
          text: "5ο εξάμηνο",
          display: true
        }
      }
    });
    // 6o εξάμηνο
    let myChart6 = document.getElementById("myChart6").getContext('2d');
    let chart6 = new Chart(myChart6, {
      type: 'pie',
      data: {
        labels: ['Επιτυχία', 'Αποτυχία'],
        datasets: [{
          data: [passed6, failed6],
          backgroundColor: ['#76a371', '#a37771']
        }]
      },
      options: {
        title: {
          text: "6ο εξάμηνο",
          display: true
        }
      }
    });
    // 7o εξάμηνο
    let myChart7 = document.getElementById("myChart7").getContext('2d');
    let chart7 = new Chart(myChart7, {
      type: 'pie',
      data: {
        labels: ['Επιτυχία', 'Αποτυχία'],
        datasets: [{
          data: [passed7, failed7],
          backgroundColor: ['#76a371', '#a37771']
        }]
      },
      options: {
        title: {
          text: "7ο εξάμηνο",
          display: true
        }
      }
    });
    // 8o εξάμηνο
    let myChart8 = document.getElementById("myChart8").getContext('2d');
    let chart8 = new Chart(myChart8, {
      type: 'pie',
      data: {
        labels: ['Επιτυχία', 'Αποτυχία'],
        datasets: [{
          data: [passed8, failed8],
          backgroundColor: ['#76a371', '#a37771']
        }]
      },
      options: {
        title: {
          text: "8ο εξάμηνο",
          display: true
        }
      }
    });
    // 9o εξάμηνο
    let myChart9 = document.getElementById("myChart9").getContext('2d');
    let chart9 = new Chart(myChart9, {
      type: 'pie',
      data: {
        labels: ['Επιτυχία', 'Αποτυχία'],
        datasets: [{
          data: [passed9, failed9],
          backgroundColor: ['#76a371', '#a37771']
        }]
      },
      options: {
        title: {
          text: "9ο εξάμηνο",
          display: true
        }
      }
    });
    // 10o εξάμηνο
    let myChart10 = document.getElementById("myChart10").getContext('2d');
    let chart10 = new Chart(myChart10, {
      type: 'pie',
      data: {
        labels: ['Επιτυχία', 'Αποτυχία'],
        datasets: [{
          data: [passed10, failed10],
          backgroundColor: ['#76a371', '#a37771']
        }]
      },
      options: {
        title: {
          text: "10ο εξάμηνο",
          display: true
        }
      }
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
