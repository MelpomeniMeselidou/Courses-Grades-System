<!DOCTYPE html>
<?php  session_start();
$link= mysqli_connect("localhost","root","","pegasus");
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}
?>
<html lang="el" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Σύστημα Ενημέρωσης Φοιτητών</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="../css/style.css ?v=<?php echo time(); ?>">
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand " href="index.php"> <img src="../img/index.png" class="logo" alt="Logo"></a>
      <div class="dep_title">
        <a href="index.php">
          
        </a>
      </div>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="navbarResponsive">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto" style="float:left; margin-left:0 !important;">
          
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Αρχική</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link btn" href="#lessons">Μαθήματα</a>
          </li>
          <li class="nav-item">

            <a class="nav-link nav-link btn" data-toggle="modal" data-target="#contact_modal">Επικοινωνία</a>
          </li>
        </ul>
		<div class="navbar-form form-inline" style="float:right;margin:auto 8px auto auto;">
  <form class="navbar-form form-inline">
            <input class="form-control form-control-sm" type="search" placeholder="Αναζήτηση μαθημάτων" aria-label="Search">
            <span class="input-group-btn">
            <button class="btn btn-sm btn-outline" type="submit">
              <i class="bx bx-search"></i>
            </button>
            </span>
          </form>
		</div>
		
		<div class="nav-item" style="float:right; margin:auto 10px auto 8px;">					<!-- GIATI DEN EINAI FLOAT RIGHT -->
		<?php if(isset($_SESSION['ifLogged_in']) && $_SESSION['ifLogged_in'] == 'YES')
          { ?>
          <a type="button" class="nav-link btn" href="logout.php">Αποσύνδεση</a>
          <?php }
          else {
            ?>

          
            <button type="button" class="nav-link btn" data-toggle="modal" data-target="#login_modal">Σύνδεση</button>
          
        <?php } ?>
      </div>
    </div>
  </nav>
  <!-- Main Container -->
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12" style="padding :0;">
        <div class="home_photo">
          <div class="main-text" style="vertical-align:middle;bottom: 212,4;top: 212.4px;">
            <h3> Καλωσήρθατε στο Νέο Σύστημα Ενημέρωσης Φοιτητών </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Lessons Container -->
  <div class="container-fluid padding"  >
    <div class="row text-center padding">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="mathimata_title" id="lessons">
          <h3> Μαθήματα Προπτυχιακού Προγράμματος</h3><br>
        </div>
        <!-- 1ο Εξάμηνο -->
        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary  dropdown-toggle btn-lg " id="dropdownLessons1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Εξάμηνο 1ο
            <span class="caret"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownLessons1">
            <p class="dropdown-header">Υποχρεωτικά Μαθήματα</p>
            <table class="table table-bordered table-md table-responsive-lg">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Τίτλος Μαθήματος</th>
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
                FROM courses c, professors p WHERE p.professor_id = c.professor_id AND c.semester = 1";
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
          </div>
        </div>
      </div>
    </div>
    <!-- 2ο Εξάμηνο -->
    <div class="row text-center padding">
      <div class="col-sx-12 col-sm-12 col-md-12 padding ">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary dropdown-toggle btn-lg " id="dropdownLessons2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Εξάμηνο 2ο
            <span class="caret"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownLessons2">
            <p class="dropdown-header">Υποχρεωτικά Μαθήματα</p>
            <table class="table table-bordered table-md table-responsive-lg">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Τίτλος Μαθήματος</th>
                  <th scope="col">Διδάσκον/ουσα</th>
                  <th scope="col">Περιγραφή</th>
                </tr>
              </thead>
              <tbody>

                  <!-- είσοδος απο php -->
                    <?php

$link= mysqli_connect("localhost","root","","pegasus");
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}

$sql = "SELECT c.course_id, c.title, p.first_name , p.last_name, c.description
 FROM courses c, professors p WHERE p.professor_id = c.professor_id AND c.semester = 2";
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
        </div>
      </div>
    </div>
    <!-- 3ο Εξάμηνο -->
    <div class="row text-center padding">
      <div class="col-sx-12 col-sm-12 col-md-12 padding ">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary dropdown-toggle btn-lg " id="dropdownLessons3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Εξάμηνο 3ο
            <span class="caret"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownLessons3">
            <p class="dropdown-header">Υποχρεωτικά Μαθήματα</p>
            <table class="table table-bordered table-md table-responsive-lg">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Τίτλος Μαθήματος</th>
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

$sql = "SELECT c.course_id, c.title, p.first_name , p.last_name, c.description  FROM courses c, professors p WHERE p.professor_id = c.professor_id AND c.semester = 3";
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
        </div>
      </div>
    </div>
    <!-- 4ο Εξάμηνο -->
    <div class="row text-center padding">
      <div class="col-sx-12 col-sm-12 col-md-12 padding ">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary dropdown-toggle btn-lg " id="dropdownLessons4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Εξάμηνο 4ο
            <span class="caret"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownLessons4">
            <p class="dropdown-header">Υποχρεωτικά Μαθήματα</p>
            <table class="table table-bordered table-md table-responsive-lg">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Τίτλος Μαθήματος</th>
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

$sql = "SELECT c.course_id, c.title, p.first_name , p.last_name, c.description  FROM courses c, professors p WHERE p.professor_id = c.professor_id AND c.semester = 4";
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
        </div>
      </div>
    </div>
    <!-- 5ο Εξάμηνο -->
    <div class="row text-center padding">
      <div class="col-sx-12 col-sm-12 col-md-12 padding ">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary dropdown-toggle btn-lg " id="dropdownLessons5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Εξάμηνο 5ο
            <span class="caret"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownLessons5">
            <p class="dropdown-header">Υποχρεωτικά Μαθήματα</p>
            <table class="table table-bordered table-md table-responsive-lg">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Τίτλος Μαθήματος</th>
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

$sql = "SELECT c.course_id, c.title, p.first_name , p.last_name, c.description  FROM courses c, professors p WHERE p.professor_id = c.professor_id AND c.semester = 5";
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
        </div>
      </div>
    </div>
    <!-- 6ο Εξάμηνο -->
    <div class="row text-center padding">
      <div class="col-sx-12 col-sm-12 col-md-12 padding ">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary dropdown-toggle btn-lg " id="dropdownLessons6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Εξάμηνο 6ο
            <span class="caret"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownLessons6">
            <p class="dropdown-header">Υποχρεωτικά Μαθήματα</p>
            <table class="table table-bordered table-md table-responsive-lg">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Τίτλος Μαθήματος</th>
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

$sql = "SELECT c.course_id, c.title, p.first_name , p.last_name, c.description  FROM courses c, professors p WHERE p.professor_id = c.professor_id AND c.semester = 6";
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
        </div>
      </div>
    </div>
    <!-- 7ο Εξάμηνο -->
    <div class="row text-center padding">
      <div class="col-sx-12 col-sm-12 col-md-12 padding ">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary dropdown-toggle btn-lg " id="dropdownLessons7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Εξάμηνο 7ο
            <span class="caret"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownLessons7">
            <p class="dropdown-header">Υποχρεωτικά Μαθήματα</p>
            <table class="table table-bordered table-md table-responsive-lg">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Τίτλος Μαθήματος</th>
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

$sql = "SELECT c.course_id, c.title, p.first_name , p.last_name, c.description  FROM courses c, professors p WHERE p.professor_id = c.professor_id AND c.semester = 7";
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
        </div>
      </div>
    </div>
    <!-- 8ο Εξάμηνο -->
    <div class="row text-center padding">
      <div class="col-sx-12 col-sm-12 col-md-12 padding ">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary dropdown-toggle btn-lg " id="dropdownLessons8" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Εξάμηνο 8ο
            <span class="caret"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownLessons8">
            <p class="dropdown-header">Υποχρεωτικά Μαθήματα</p>
            <table class="table table-bordered table-md table-responsive-lg">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Τίτλος Μαθήματος</th>
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

$sql = "SELECT c.course_id, c.title, p.first_name , p.last_name, c.description  FROM courses c, professors p WHERE p.professor_id = c.professor_id AND c.semester = 8";
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
        </div>
      </div>
    </div>
    <!-- 9ο Εξάμηνο -->
    <div class="row text-center padding">
      <div class="col-sx-12 col-sm-12 col-md-12 padding ">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary dropdown-toggle btn-lg " id="dropdownLessons9" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Εξάμηνο 9ο
            <span class="caret"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownLessons9">
            <p class="dropdown-header">Υποχρεωτικά Μαθήματα</p>
            <table class="table table-bordered table-md table-responsive-lg">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Τίτλος Μαθήματος</th>
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

$sql = "SELECT c.course_id, c.title, p.first_name , p.last_name, c.description  FROM courses c, professors p WHERE p.professor_id = c.professor_id AND c.semester = 9";
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
        </div>
      </div>
    </div>
    <!-- 10ο Εξάμηνο -->
    <div class="row text-center padding">
      <div class="col-sx-12 col-sm-12 col-md-12 padding ">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary dropdown-toggle btn-lg " id="dropdownLessons10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Εξάμηνο 10ο
            <span class="caret"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownLessons10">
            <p class="dropdown-header">Υποχρεωτικά Μαθήματα</p>
            <table class="table table-bordered table-md table-responsive-lg">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Τίτλος Μαθήματος</th>
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

$sql = "SELECT c.course_id, c.title, p.first_name , p.last_name, c.description  FROM courses c, professors p WHERE p.professor_id = c.professor_id AND c.semester = 10";
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
        </div>
      </div>
    </div>
    <br>
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
  <!-- Login Modal -->
  <div id="login_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="LoginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="LoginModalTitle">Εισάγεται στοιχεία χρήστη</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="login.php" method="post">
            <div class="form-group">
              <label for="username">Αριθμός Μητρώου Χρήστη</label>
              <input type="username" class="form-control" name = "username" id="username" placeholder="Αριθμός Μητρώου" required="required" data-validation-required-message="Παρακαλώ εισάγετε username.">
            </div>
            <div class="form-group">
              <label for="password">Κωδικός</label>
              <input type="password" class="form-control" name = "password" id="password" placeholder="Κωδικός" required="required" data-validation-required-message="Παρακαλώ εισάγετε κωδικό.">

		   </div>
		   <div class="modal-footer">
		  <button type="button" class="btn " data-toggle="modal" data-target="#register_modal" style="float:left; margin:auto auto auto 0;">Δημιουργία Λογαριασμού</button>
          <button type="submit" class="btn" id="submit" onclick= "validate();" >Σύνδεση</button>
          <button type="button" class="btn " data-dismiss="modal">Κλείσιμο</button>
        </div>
		<div style="margin:auto; padding:0px 16px;">
			<a href="402.php" style="font-size:80%; color:blue;">Ξέχασα τον κωδικό μου</a>
			<a href="mailto:admin@aegean.gr" style="font-size:80%; margin-left:16px; color:blue;">Ξέχασα το username και τον κωδικό μου</a>
		</div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- Register Modal -->
  <div id="register_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="RegisterModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="RegisterModalTitle">Δημιουργία Λογαριασμού</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="register.php" method="post">
              <div class="form-group">
                <label for="InputName">Όνομα</label>
                <input type="text" class="form-control" name = "first_name" id="InputName" placeholder="Εισάγετε όνομα" required="required" data-validation-required-message="Παρακαλώ εισάγετε όνομα.">
              </div>
              <div class="form-group">
                <label for="InputSurname">Επίθετο</label>
                <input type="text" class="form-control" name = "last_name" id="InputSurname" placeholder="Εισάγετε επίθετο" required="required" data-validation-required-message="Παρακαλώ εισάγετε επίθετο.">
              </div>
			  
			   <div class="form-group">
                <label for="Email">E-mail</label>
                <input type="email" class="form-control" name = "email" id="email" placeholder="Εισάγετε email" required="required"
                data-validation-required-message="Παρακαλώ εισάγετε email.">
              </div>
  			         <div class="form-group">
                <label for="Password">Κωδικός</label>
                <input type="password" class="form-control" name = "password" id="Password" placeholder="Εισάγετε μυστικό κωδικό" required="required"
                data-validation-required-message="Παρακαλώ εισάγετε κωδικό.">
              </div>

              <div class="form-group">
                <label for="role_id" >Ιδιότητα</label>
                <select id="role_id" name="role_id">
                  <option value="1" >Φοιτητής</option>
                  <option value="2" >Καθηγητής</option>

                </select>
              </div>
              <div class="form-group" id="year_div">
                <label for="year">Έτος εισαγωγής</label>
                <select id="year" name="year">
                  <option value="2010">2010</option>
                  <option value="2011">2011</option>
                  <option value="2012">2012</option>
                  <option value="2013">2013</option>
                  <option value="2014">2014</option>
                  <option value="2015">2015</option>
                  <option value="2016">2016</option>
                  <option value="2017">2017</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                </select>
              </div>
              <div class="form-group" id="prof_step_div">
                <label for="prof_step">Βαθμίδα Καθηγητή</label>
                <select id="prof_step" name="step">
                  <option value="epikouros">Επίκουρος Καθηγητής</option>
                  <option value="anaplirotis">Αναπληρωτής Καθηγητής</option>
                  <option value="kathigitis">Καθηγητής</option>
                </select>
              </div>
  			<div class="modal-footer">
            <button type="submit" class="btn ">Εγγραφή</button>
            <button type="button" class="btn " data-dismiss="modal">Κλείσιμο</button>
          </div>
              <script type="text/javascript">
                $("#role_id").change(function() {
                  if ($(this).val() == "1") {
                    $('#year_div').show();
                    $('#year').attr('required', '');
                    $('#year').attr('data-error', 'This field is required.');
                  }else{
                    $('#year_div').hide();
                    $('#year').removeAttr('required');
                    $('#year').removeAttr('data-error');
                  }
                });
                $("#role_id").trigger("change");

                $("#role_id").change(function() {
                  if ($(this).val() == "2") {
                    $('#prof_step_div').show();
                    $('#prof_step').attr('required', '');
                    $('prof_step').attr('data-error', 'This field is required.');
                  }else{
                    $('#prof_step_div').hide();
                    $('prof_step').removeAttr('required');
                    $('prof_step').removeAttr('data-error');
                  }
                });
                $("#role_id").trigger("change");

              </script>
            </form>
          </div>

        </div>
      </div>
    </div>
  <!-- Footer  -->
  <div class="container-fluid padding">
    <div class="row text-center">
      <div class="col-12 col-lg-12 footer">
        <a href="http://www.icsd.aegean.gr" target="_blank"> Τμήμα Πληροφοριακών και Επικοινωνιακών Συστημάτων</a>
        <a href="http://www.aegean.gr" target="_blank"> |Πανεπιστήμιο Αιγαίου</a>
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
