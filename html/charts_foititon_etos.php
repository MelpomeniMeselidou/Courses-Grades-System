<!DOCTYPE html>
<html lang="el" dir="ltr">

<?php  session_start();
$professor_id = $_SESSION['professor_id'];
$link= mysqli_connect("localhost","root","","pegasus");
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      <h3 class="mathimata">Στατιστικά</h3><br>
      <div class="container-fluid">
        <h4>Απόδοση φοιτητών ανά έτος και εξάμηνο: </h4>
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
      </div>
	   
      <div class="container tab-content">
	  <?php  
		  $sql = " SELECT c.course_id, c.title, c.semester FROM courses c, professors p 
						WHERE c.professor_id = '$professor_id' AND c.professor_id = p.professor_id";
		  $result = $link->query($sql);

		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
			$course_id = $row['course_id'];
			$title = $row['course_id'];
	 ?>
	 <?php if($row['semester'] == 1 || $row['semester'] == 2) {?>
        <div id="etos1" class="tab-pane fade show active">
          <div class="row">
		<?php if($row['semester'] == 1){
			?>
            <!-- 1ο Εξάμηνο -->
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header">
                  <i class='bx bx-pie-chart-alt-2'></i>
                 <?php echo $row['semester'] ."ο εξάμηνο" ?>
                </div>
                <div class="card-body">
                  <canvas id="myChart1" width="300" height="300"></canvas>
                </div>
              </div>
            </div>
		<?php }  else if($row['semester'] == 2){
			?>
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
		 <?php } ?>
          </div>
        </div>
	<?php } else if($row['semester'] == 3 || $row['semester'] == 4) { ?>
        <div id="etos2" class="tab-pane fade">
          <div class="row">
            <!-- 3ο Εξάμηνο -->
			<?php if($row['semester'] == 3){
			?>
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header">
                  <i class='bx bx-pie-chart-alt-2'></i>
                   <?php echo $row['semester'] ."ο εξάμηνο" ?>
                </div>
                <div class="card-body">
                  <canvas id="myChart3" width="300" height="300"></canvas>
                </div>
              </div>
            </div>
			<?php } else if($row['semester'] == 4){
			?>
            <!-- 4ο Εξάμηνο -->
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header">
                  <i class='bx bx-pie-chart-alt-2'></i>
                   <?php echo $row['semester'] ."ο εξάμηνο" ?>
                </div>
                <div class="card-body">
                  <canvas id="myChart4" width="300" height="300"></canvas>
                </div>
              </div>
            </div>
			<?php } ?>
          </div>
        </div>
		<?php } else if($row['semester'] == 5 || $row['semester'] == 6) { ?>
        <div id="etos3" class="tab-pane fade">
          <div class="row">
		  <?php if($row['semester'] == 5){
			?>
            <!-- 5ο Εξάμηνο -->
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header">
                  <i class='bx bx-pie-chart-alt-2'></i>
                  <?php echo $row['semester'] ."ο εξάμηνο" ?>ο
                </div>
                <div class="card-body">
                  <canvas id="myChart5" width="300" height="300"></canvas>
                </div>
              </div>
            </div>
		  <?php } else if($row['semester'] == 6){
			?>
            <!-- 6ο Εξάμηνο -->
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header">
                  <i class='bx bx-pie-chart-alt-2'></i>
                   <?php echo $row['semester'] ."ο εξάμηνο" ?>
                </div>
                <div class="card-body">
                  <canvas id="myChart6" width="300" height="300"></canvas>
                </div>
              </div>
            </div>
			<?php } ?>
          </div>
        </div>
		<?php } else if($row['semester'] == 7 || $row['semester'] == 8) { ?>
        <div id="etos4" class="tab-pane fade">
          <div class="row">
            <!-- 7ο Εξάμηνο -->
			  <?php if($row['semester'] == 7){
			?>
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header">
                  <i class='bx bx-pie-chart-alt-2'></i>
                   <?php echo $row['semester'] ."ο εξάμηνο" ?>
                </div>
                <div class="card-body">
                  <canvas id="myChart7" width="300" height="300"></canvas>
                </div>
              </div>
            </div>
			  <?php } else if($row['semester'] == 8){
			?>
            <!-- 8ο Εξάμηνο -->
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header">
                  <i class='bx bx-pie-chart-alt-2'></i>
                   <?php echo $row['semester'] ."ο εξάμηνο" ?>
                </div>
                <div class="card-body">
                  <canvas id="myChart8" width="300" height="300"></canvas>
                </div>
              </div>
            </div>
			<?php } ?>
          </div>
        </div>
		<?php } else if($row['semester'] == 9 || $row['semester'] == 10) { ?>
        <div id="etos5" class="tab-pane fade">
          <div class="row">
		   <?php if($row['semester'] == 9){
			?>
            <!-- 9ο Εξάμηνο -->
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header">
                  <i class='bx bx-pie-chart-alt-2'></i>
                   <?php echo $row['semester'] ."ο εξάμηνο" ?>
                </div>
                <div class="card-body">
                  <canvas id="myChart9" width="300" height="300"></canvas>
                </div>
              </div>
            </div>
		<?php } else if($row['semester'] == 10){
			?>
            <!-- 10ο Εξάμηνο -->
            <div class="col-lg-6">
              <div class="card mb-4">
                <div class="card-header">
                  <i class='bx bx-pie-chart-alt-2'></i>
                   <?php echo $row['semester'] ."ο εξάμηνο" ?>
                </div>
                <div class="card-body">
                  <canvas id="myChart10" width="300" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>
		  <?php } ?>
        </div>
      </div>
		<?php } ?>
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
		 
		 
		  
		  $sql = "SELECT DISTINCT c.course_id, c.title, c.semester, g.final_grade
                   
					FROM courses c, students s, grades g, course_statements cs
					WHERE c.course_id = '$course_id' AND c.course_id = g.course_id AND g.ifFinalized =1 AND c.semester = 1";
                     
			 $result = $link->query($sql);
			 $total1=0;
			 $passed1=0;
			 $failed1=0;
		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
		if($row['final_grade'] >= 5){
			$passed1 += 1;
		}else{ $failed1 +=1;
			
		}
		}
		$total1 = $passed1 + $failed1;
		}
	
	?>
	<script type="text/javascript">
    var failed1 = <?php Print($failed1); ?>;
    var passed1 = <?php Print($passed1); ?>;
	</script>
    <?php  
		 
		 
		  
		  $sql = "SELECT DISTINCT c.course_id, c.title, c.semester, g.final_grade
                   
					FROM courses c, students s, grades g, course_statements cs
					WHERE c.course_id = '$course_id' AND c.course_id = g.course_id AND g.ifFinalized =1 AND c.semester = 2";
                     
			 $result = $link->query($sql);
			 $total2=0;
			 $passed2=0;
			 $failed2=0;
		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
		if($row['final_grade'] >= 5){
			$passed2 += 1;
		}else{ $failed2 +=1;
			
		}
		}
		$total2 = $passed2 + $failed2;
		}
	
	?>
	<script type="text/javascript">
    var failed2 = <?php Print($failed2); ?>;
    var passed2 = <?php Print($passed2); ?>;
	</script>
	   <?php  
		 
		 
		  
		  $sql = "SELECT DISTINCT c.course_id, c.title, c.semester, g.final_grade
                   
					FROM courses c, students s, grades g, course_statements cs
					WHERE c.course_id = '$course_id' AND c.course_id = g.course_id AND g.ifFinalized =1 AND c.semester = 3";
                     
			 $result = $link->query($sql);
			 $total3=0;
			 $passed3=0;
			 $failed3=0;
		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
		if($row['final_grade'] >= 5){
			$passed3 += 1;
		}else{ $failed3 +=1;
			
		}
		}
		$total3 = $passed3 + $failed3;
		}
	
	?>
	<script type="text/javascript">
    var failed3 = <?php Print($failed3); ?>;
    var passed3 = <?php Print($passed3); ?>;
	</script>
	   <?php  
		 
		 
		  
		  $sql = "SELECT DISTINCT c.course_id, c.title, c.semester, g.final_grade
                   
					FROM courses c, students s, grades g, course_statements cs
					WHERE c.course_id = '$course_id' AND c.course_id = g.course_id AND g.ifFinalized =1 AND c.semester = 4";
                     
			 $result = $link->query($sql);
			 $total4=0;
			 $passed4=0;
			 $failed4=0;
		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
		if($row['final_grade'] >= 5){
			$passed4 += 1;
		}else{ $failed4 +=1;
			
		}
		}
		$total4 = $passed4 + $failed4;
		}
	
	?>
	<script type="text/javascript">
    var failed4 = <?php Print($failed4); ?>;
    var passed4 = <?php Print($passed4); ?>;
	</script>
	   <?php  
		 
		 
		  
		  $sql = "SELECT DISTINCT c.course_id, c.title, c.semester, g.final_grade
                   
					FROM courses c, students s, grades g, course_statements cs
					WHERE c.course_id = '$course_id' AND c.course_id = g.course_id AND g.ifFinalized =1 AND c.semester = 5";
                     
			 $result = $link->query($sql);
			 $total5=0;
			 $passed5=0;
			 $failed5=0;
		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
		if($row['final_grade'] >= 5){
			$passed5 += 1;
		}else{ $failed5 +=1;
			
		}
		}
		$total5 = $passed5 + $failed5;
		}
	
	?>
	<script type="text/javascript">
    var failed5 = <?php Print($failed5); ?>;
    var passed5 = <?php Print($passed5); ?>;
	</script>
	   <?php  
		 
		 
		  
		  $sql = "SELECT DISTINCT c.course_id, c.title, c.semester, g.final_grade
                   
					FROM courses c, students s, grades g, course_statements cs
					WHERE c.course_id = '$course_id' AND c.course_id = g.course_id AND g.ifFinalized =1 AND c.semester = 6";
                     
			 $result = $link->query($sql);
			 $total6=0;
			 $passed6=0;
			 $failed6=0;
		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
		if($row['final_grade'] >= 5){
			$passed6 += 1;
		}else{ $failed6 +=1;
			
		}
		}
		$total6 = $passed6 + $failed6;
		}
	
	?>
	<script type="text/javascript">
    var failed6 = <?php Print($failed6); ?>;
    var passed6 = <?php Print($passed6); ?>;
	</script>
	   <?php  
		 
		 
		  
		  $sql = "SELECT DISTINCT c.course_id, c.title, c.semester, g.final_grade
                   
					FROM courses c, students s, grades g, course_statements cs
					WHERE c.course_id = '$course_id' AND c.course_id = g.course_id AND g.ifFinalized =1 AND c.semester = 7";
                     
			 $result = $link->query($sql);
			 $total7=0;
			 $passed7=0;
			 $failed7=0;
		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
		if($row['final_grade'] >= 5){
			$passed7 += 1;
		}else{ $failed7 +=1;
			
		}
		}
		$total7 = $passed7 + $failed7;
		}
	
	?>
	<script type="text/javascript">
    var failed7 = <?php Print($failed7); ?>;
    var passed7 = <?php Print($passed7); ?>;
	</script>
	   <?php  
		 
		 
		  
		  $sql = "SELECT DISTINCT c.course_id, c.title, c.semester, g.final_grade
                   
					FROM courses c, students s, grades g, course_statements cs
					WHERE c.course_id = '$course_id' AND c.course_id = g.course_id AND g.ifFinalized =1 AND c.semester = 8";
                     
			 $result = $link->query($sql);
			 $total8=0;
			 $passed8=0;
			 $failed8=0;
		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
		if($row['final_grade'] >= 5){
			$passed8 += 1;
		}else{ $failed8 +=1;
			
		}
		}
		$total8 = $passed8 + $failed8;
		}
	
	?>
	<script type="text/javascript">
    var failed8 = <?php Print($failed8); ?>;
    var passed8 = <?php Print($passed8); ?>;
	</script>
	   <?php  
		 
		 
		  
		  $sql = "SELECT DISTINCT c.course_id, c.title, c.semester, g.final_grade
                   
					FROM courses c, students s, grades g, course_statements cs
					WHERE c.course_id = '$course_id' AND c.course_id = g.course_id AND g.ifFinalized =1 AND c.semester = 9";
                     
			 $result = $link->query($sql);
			 $total9=0;
			 $passed9=0;
			 $failed9=0;
		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
		if($row['final_grade'] >= 5){
			$passed9 += 1;
		}else{ $failed9 +=1;
			
		}
		}
		$total9 = $passed9 + $failed9;
		}
	?>
	<script type="text/javascript">
    var failed9 = <?php Print($failed9); ?>;
    var passed9 = <?php Print($passed9); ?>;
	</script>
	   <?php  
		 
		 
		  
		  $sql = "SELECT DISTINCT c.course_id, c.title, c.semester, g.final_grade
                   
					FROM courses c, students s, grades g, course_statements cs
					WHERE c.course_id = '$course_id' AND c.course_id = g.course_id AND g.ifFinalized =1 AND c.semester = 10";
                     
			 $result = $link->query($sql);
			 $total10=0;
			 $passed10=0;
			 $failed10=0;
		if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()){
		if($row['final_grade'] >= 5){
			$passed10 += 1;
		}else{ $failed10 +=1;
			
		}
		}
		
		$total10 = $passed10 + $failed10;
		}
		}}
	?>
	<script type="text/javascript">
    var failed10 = <?php Print($failed10); ?>;
    var passed10 = <?php Print($passed10); ?>;
	</script>
<!-- Chart Scripts -->
<!-- php ???-->
  <script type="text/javascript">
  // Μάθημα 1
  let myChart1 = document.getElementById("myChart1").getContext('2d');
  let chart1 = new Chart(myChart1, {
    type: 'pie',
    data: {
      labels: ['Επιτυχείς', 'Αποτυχείς'],
      datasets: [{
        data: [passed1, failed1],
        backgroundColor: ['#76a371', '#a37771']
      }]
    },
    options: {
      title: {
        text: "Τίτλος Μαθήματος",
        display: true
      }
    }
  });
  </script>
   <script type="text/javascript">
  // Μάθημα 2
  let myChart2 = document.getElementById("myChart2").getContext('2d');
  let chart2 = new Chart(myChart2, {
    type: 'pie',
    data: {
      labels: ['Επιτυχείς', 'Αποτυχείς'],
      datasets: [{
        data: [passed2, failed2],
        backgroundColor: ['#76a371', '#a37771']
      }]
    },
    options: {
      title: {
        text: "Τίτλος Μαθήματος",
        display: true
      }
    }
  });
  </script>
   <script type="text/javascript">
  // Μάθημα 3
  let myChart3 = document.getElementById("myChart3").getContext('2d');
  let chart3 = new Chart(myChart3, {
    type: 'pie',
    data: {
      labels: ['Επιτυχείς', 'Αποτυχείς'],
      datasets: [{
         data: [passed3, failed3],
        backgroundColor: ['#76a371', '#a37771']
      }]
    },
    options: {
      title: {
        text: "Τίτλος Μαθήματος",
        display: true
      }
    }
  });
  </script>
   <script type="text/javascript">
  // Μάθημα 4
  let myChart4 = document.getElementById("myChart4").getContext('2d');
  let chart4 = new Chart(myChart4, {
    type: 'pie',
    data: {
      labels: ['Επιτυχείς', 'Αποτυχείς'],
      datasets: [{
         data: [passed4, failed4],
        backgroundColor: ['#76a371', '#a37771']
      }]
    },
    options: {
      title: {
        text: "Τίτλος Μαθήματος",
        display: true
      }
    }
  });
  </script>
   <script type="text/javascript">
  // Μάθημα 1
  let myChart5 = document.getElementById("myChart5").getContext('2d');
  let chart5 = new Chart(myChart5, {
    type: 'pie',
    data: {
      labels: ['Επιτυχείς', 'Αποτυχείς'],
      datasets: [{
         data: [passed5, failed5],
        backgroundColor: ['#76a371', '#a37771']
      }]
    },
    options: {
      title: {
        text: "Τίτλος Μαθήματος",
        display: true
      }
    }
  });
  </script>
   <script type="text/javascript">
  // Μάθημα 6
  let myChart6 = document.getElementById("myChart6").getContext('2d');
  let chart6 = new Chart(myChart6, {
    type: 'pie',
    data: {
      labels: ['Επιτυχείς', 'Αποτυχείς'],
      datasets: [{
        data: [passed6, failed6],
        backgroundColor: ['#76a371', '#a37771']
      }]
    },
    options: {
      title: {
        text: "Τίτλος Μαθήματος",
        display: true
      }
    }
  });
  </script>
   <script type="text/javascript">
  // Μάθημα 7
  let myChart1 = document.getElementById("myChart7").getContext('2d');
  let chart7 = new Chart(myChart7, {
    type: 'pie',
    data: {
      labels: ['Επιτυχείς', 'Αποτυχείς'],
      datasets: [{
        d data: [passed7, failed7],
        backgroundColor: ['#76a371', '#a37771']
      }]
    },
    options: {
      title: {
        text: "Τίτλος Μαθήματος",
        display: true
      }
    }
  });
  </script>
   <script type="text/javascript">
  // Μάθημα 8
  let myChart8 = document.getElementById("myChart8").getContext('2d');
  let chart8 = new Chart(myChart8, {
    type: 'pie',
    data: {
      labels: ['Επιτυχείς', 'Αποτυχείς'],
      datasets: [{
         data: [passed8, failed8],
        backgroundColor: ['#76a371', '#a37771']
      }]
    },
    options: {
      title: {
        text: "Τίτλος Μαθήματος",
        display: true
      }
    }
  });
  </script>
   <script type="text/javascript">
  // Μάθημα 9
  let myChart9 = document.getElementById("myChart9").getContext('2d');
  let chart9 = new Chart(myChart9, {
    type: 'pie',
    data: {
      labels: ['Επιτυχείς', 'Αποτυχείς'],
      datasets: [{
         data: [passed9, failed9],
        backgroundColor: ['#76a371', '#a37771']
      }]
    },
    options: {
      title: {
        text: "Τίτλος Μαθήματος",
        display: true
      }
    }
  });
  </script>
   <script type="text/javascript">
  // Μάθημα 10
  let myChart10 = document.getElementById("myChart10").getContext('2d');
  let chart10 = new Chart(myChart10, {
    type: 'pie',
    data: {
      labels: ['Επιτυχείς', 'Αποτυχείς'],
      datasets: [{
         data: [passed10, failed10],
        backgroundColor: ['#76a371', '#a37771']
      }]
    },
    options: {
      title: {
        text: "Τίτλος Μαθήματος",
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
