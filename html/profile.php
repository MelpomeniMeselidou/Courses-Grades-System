<!DOCTYPE html>

<?php  session_start();
$role_id = $_SESSION['role_id'];

    if($role_id == 1){
		$user_id = $_SESSION['student_id'];
	}else if($role_id == 2){
		$user_id = $_SESSION['professor_id'];
	}else if($role_id == 3){
		$user_id = $_SESSION['administrator_id'];
	}

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
  <link rel="stylesheet" type="text/css" href="../css/style.css ?v=<?php echo time();?>">
  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <!-- Vertical Navbar -->
  <!-- Είσοδος ως student -->
  <?php if($role_id==1) { ?>
  <div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center">
        <a href="profile.php"><img src="../img/logo.png"
          class="mr-3 rounded-circle img-thumbnail shadow-sm" alt="logo" width="80">
        </a>
        <div class="media-body">
          <h3 class="m-0"> <?php echo $user_id; ?> -
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
        <a href="logout.php" class="nav-link text-dark bg-gray">
          <i class='bx bx-log-out'></i>
          Αποσύνδεση
        </a>
      </li>
    </ul>
  </div>
  <?php } ?>

  <!-- Είσοδος ως professor -->
  <?php if($role_id==2) { ?>
  <div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center">
        <img src="../img/logo.png" class="mr-3 rounded-circle img-thumbnail shadow-sm" alt="logo" width="80">
        <div class="media-body">
          <h3 class="m-0"><?php echo $_SESSION['professor_id']; ?> -
            <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></h3>
          <p class="font-weight-normal text-muted mb-0"> <?php echo $_SESSION['description']; ?></p>
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
  <?php } ?>

  <!-- Είσοδος ως administrator -->
  <?php if($role_id==3) { ?>
  <div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center">
        <a href="admin_main.php"><img src="../img/logo.png"
          class="mr-3 rounded-circle img-thumbnail shadow-sm" alt="logo" width="80">
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
  <?php } ?>
  <!-- End of vertical navbar -->

  <!-- Page content -->
  <div class="page-content content-photo p-4" id="content">
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4">
      <i class='bx bx-menu'></i>
    </button>
    <div class="col-lg-12" >
      <h3 class="mathimata">Το Προφιλ μου</h3><br>
      <div class="container-fluid">
        <div class="col-lg-12">
          <div class="row d-flex justify-content-lg-center">
            <div class="profile-content-header col-6">
              <div class="profile-name">
                <h5><?php echo $_SESSION['first_name'];?> <?php echo $_SESSION['last_name']; ?></h5>
              </div>
              <div class="text-gray">
                <h6><?php echo $user_id; ?></h6>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 d-flex justify-content-lg-around">
              <div>
			   <?php
			   if($role_id == 1){
			       $sql = "SELECT s.student_id, s.first_name, s.last_name, s.email
                    FROM students s WHERE s.student_id = '$user_id' ";
			   }else if($role_id == 2){
					$sql = "SELECT p.professor_id, p.first_name, p.last_name, p.vathmida, p.email
                    FROM professors p WHERE p.professor_id = '$user_id' ";
			   }else if($role_id == 3){
					$sql = "SELECT a.administrator_id, a.first_name, a.last_name, a.email
                    FROM administrators a WHERE a.administrator_id = '$user_id' ";
			   }
                    $result = $link->query($sql);

                    if ($result->num_rows > 0) {
                      ?>

                      <?php
                      while($row = $result->fetch_assoc()){
	                     ?>
                <div class="profile-content-title">
                  <p class="text-gray font-weight-bold text-uppercase small">Προσωπικά Στοιχεία</p>
                </div>
                <div class="profile-content-form">
                  <form action="#" method="post">
                    <div class="form-group row">
                      <label class="col-6 col-form-label" for="InputId">Αριθμός Μητρώου: </label>
                      <input readonly type="" class="col-4 form-control" id="InputId" value="<?php echo $user_id ; ?>">
                    </div>
                    <div class="form-group row">
                      <label class="col-6 col-form-label" for="InputName">Όνομα: </label>
                      <input readonly type="text" class="col-4 form-control" id="InputName" value="<?php echo $row['first_name']; ?>">
                    </div>
                    <div class="form-group row">
                      <label class="col-6 col-form-label" for="InputLastName">Επίθετο: </label>
                      <input readonly type="text" class="col-4 form-control" id="InputLastName" value="<?php echo $row['last_name']; ?>">
                    </div>
					<?php if($role_id == 1){
						?>
						 <div class="form-group row">
                      <label class="col-6 col-form-label" for="InputRole">Ιδιότητα: </label>
                      <input readonly type="text" class="col-4 form-control" id="InputRole" value="Student">
                    </div>
			       <?php
			   }else if($role_id == 2){
					?>
					<div class="form-group row">
                      <label class="col-6 col-form-label" for="InputRole">Ιδιότητα: </label>
                      <input readonly type="text" class="col-4 form-control" id="InputRole" value="Professor">
                    </div>
					<div class="form-group row">
                      <label class="col-6 col-form-label" for="InputVathmida">Ιδιότητα: </label>
                      <input readonly type="text" class="col-4 form-control" id="InputRole" value="<?php echo $row['vathmida']; ?>">
                    </div>

					<?php
			   }
			   ?>

                    <div class="form-group row">
                      <label class="col-6 col-form-label" for="InputEmail">Email: </label>
                      <input readonly type="email" class="col-4 form-control" id="InputEmail" value="<?php echo $row['email']; ?>">
                    </div>

					<?php
        }}
					?>
                    <br />
                    <div class="form-group password_chng_btn">
                      <a class="btn btn-light btn-lg" data-toggle="modal" type="submit" data-target="#new_password_modal">Αλλαγή μυστικού κωδικού</a>
                    </div>
                    <br>
                  </form>
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

  <script type="text/javascript">
    $(function() {
      $('#sidebarCollapse').on('click', function() {
        $('#sidebar,#content').toggleClass('active');
      });
    });
  </script>
  <!-- Change Password Modal -->
  <div id="new_password_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="NewPasswordModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="NewPasswordModalTitle">Στοιχεία Επικοινωνίας</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="change_password.php" method="post">
            <div class="form-group">
              <label for="new_password">Νέος Μυστικός Κωδικός</label>
              <input type="password" class="form-control" name ="new_password" id="new_password" placeholder="Enter new password" required="required" data-validation-required-message="Παρακαλώ εισάγετε νέο κωδικό.">
            </div>
            <div class="form-group">
              <label for="new_password2">Επιβεβαίωση Μυστικού Κωδικού</label>
              <input type="password" class="form-control" name = "confirmed_password" id="confirmed_password" placeholder="Κωδικός" required="required" data-validation-required-message="Επιβεβαίωση εισαγωγής κωδικού.">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn">Αποθήκευση Αλλαγών</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
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
  <script type="text/javascript">
  function validate() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            if (username == null || username == "") {
                alert("Please enter the username.");
                return false;
            }
            if (password == null || password == "") {
                alert("Please enter the password.");
                return false;
            }
            alert('Login successful');
            
        } 

</script>

</html>
