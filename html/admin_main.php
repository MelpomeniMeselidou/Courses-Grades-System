<!DOCTYPE html>
<html lang="el" dir="ltr">

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
  <link rel="stylesheet" type="text/css" href="../css/style.css ?v=<?php echo time(); ?> " />
  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <!-- Vertical Navbar -->
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
        <a href="admin_edit_courses_per.php" class="nav-link text-dark ">
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
    <div class="col-lg-12">
      <h3 class="mathimata">Μαθήματα ΜΠΕΣ</h3><br>
      <table class="table table-light table-bordered table-md table-responsive-lg">
        <thead class="thead-light">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Τίτλος Μαθήματος</th>
            <th scope="col">Εξάμηνο</th>
            <th scope="col">Διδάσκον/ουσα</th>
            <th scope="col">Περιγραφή</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $link= mysqli_connect("localhost","root","","pegasus");
          if ($link->connect_error) {
            die("Connection failed: " . $link->connect_error);
          }

          $sql = "SELECT c.course_id, c.title, p.first_name , p.last_name , c.description
          FROM courses c, professors p WHERE p.professor_id = c.professor_id";
          $result = $link->query($sql);

          if ($result->num_rows > 0) {
          ?>

          <?php
          while($row = $result->fetch_assoc()){
          ?>

          <tr>
              <th scope="row"> <?php echo $row['course_id']; ?> </th>
              <th scope="row"> <?php echo $row['title']; ?> </th>
              <th scope="row"> <?php echo $row['first_name'] . " " . $row['last_name']; ?> </th>
              <th scope="row"> <?php echo $row['description']; ?> </th>
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
      <br />
      </div>
      <div class="col-lg-12">
        <h4 class="mathimata">Εισαγωγή νέου μαθήματος</h4><br>
        <div class="container-fluid">
          <div class="col-lg-12">
            <div class="row d-flex justify-content-lg-center">
              <form class="new_course_form" action="index.html" method="post">
                <div class="form-group">
                  <label for="InputCourseProf">Ανάθεση σε Καθηγητή</label>
                  <select class="form-control" id="InputCourseProf">
                    <option value="1">-</option>
                    <option value="2">Καθηγητής 1</option>
                    <option value="3">Καθηγητής 2</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="InputCourseTitle">Τίτλος Μαθήματος</label>
                  <input type="text" class="form-control" id="InputCourseTitle">
                </div>
                <div class="form-group">
                  <label for="InputCourseProf">Εξάμηνο</label>
                  <select class="form-control" id="InputCourseProf">
                    <option value="1">Εξάμηνο 1ο</option>
                    <option value="2">Εξάμηνο 2ο</option>
                    <option value="3">Εξάμηνο 3ο</option>
                    <option value="4">Εξάμηνο 4ο</option>
                    <option value="5">Εξάμηνο 5ο</option>
                    <option value="6">Εξάμηνο 6ο</option>
                    <option value="7">Εξάμηνο 7ο</option>
                    <option value="8">Εξάμηνο 8ο</option>
                    <option value="9">Εξάμηνο 9ο</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="InputThPercentage">Ποσοστό Βαθμού Θεωρίας</label>
                  <input type="text" class="form-control" id="InputThPercentage">
                </div>
                <div class="form-group">
                  <label for="ThGrStays">Διατήρηση Βαθμού Θεωρίας</label>
                  <select class="form-control-sm" id="ThGrStays">
                    <option value="1">Χωρίς δυνατότητα διατήρησης βαθμού</option>
                    <option value="2">1 Ακαδημαϊκό έτος</option>
                    <option value="3">2 Ακαδημαϊκά έτη</option>
                    <option value="4">Αορίστου χρόνου</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="InputLabPercentage">Ποσοστό Βαθμού Εργαστηρίου</label>
                  <input type="text" class="form-control" id="InputLabPercentage">
                </div>
                <div class="form-group">
                  <label for="LabGrStays">Διατήρηση Βαθμού Εργαστηρίου</label>
                  <select class="form-control-sm" id="LabGrStays">
                    <option value="1">Χωρίς δυνατότητα διατήρησης βαθμού</option>
                    <option value="2">1 Ακαδημαϊκό έτος</option>
                    <option value="3">2 Ακαδημαϊκά έτη</option>
                    <option value="4">Αορίστου χρόνου</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="CourseDescription">Περιγραφή Μαθήματος</label>
                  <textarea class="form-control" id="CourseDescription" rows="5"></textarea>
                </div>
                <button type="submit" name="newCourseButton" class="btn btn-light btn-sm">Αποθήκευση</button>
              </form>
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
