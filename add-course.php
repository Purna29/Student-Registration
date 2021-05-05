<?php
session_start();
include('config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {

  if (isset($_POST['submit'])) {
    $crn = $_POST['crn'];
    $course = $_POST['course'];
    $coursename = $_POST['coursename'];
    $noofcredits = $_POST['noofcredits'];
    $location = $_POST['location'];
    $level = $_POST['level'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $instructor = $_POST['instructor'];

    $ret = mysqli_query($con, "insert into course(CRN, course ,courseName, noOfCredits, location, level, startDate, endDate, instructor) values('$crn', '$course', '$coursename', '$noofcredits', '$location', '$level', '$startdate', '$enddate', '$instructor')");
    if ($ret) {
      $_SESSION['msg'] = "Course Created Successfully !!";
    } else {
      $_SESSION['msg'] = "Error : Course not created";
    }
  }
  if (isset($_GET['del'])) {
    mysqli_query($con, "delete from course where id = '" . $_GET['id'] . "'");
    $_SESSION['delmsg'] = "Course deleted !!";
  }
?>

  <!DOCTYPE html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Admin | Course</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <?php include('adminheader.php'); ?>
    <?php if ($_SESSION['alogin'] != "") {
      include('adminmenubar.php');
    }
    ?>
    <div class="content-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-head-line">Course </h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                Add Course
              </div>
              <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>


              <div class="panel-body">
                <form name="dept" method="post">
                  <div class="form-group">
                    <label for="crn">CRN </label>
                    <input type="text" class="form-control" id="crn" name="crn" placeholder="Enter CRN" required />
                  </div>
                  <div class="form-group">
                    <label for="course">Course </label>
                    <input type="text" class="form-control" id="course" name="course" placeholder="Enter Course" required />
                  </div>

                  <div class="form-group">
                    <label for="coursename">Course Name </label>
                    <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Enter Course Name" required />
                  </div>

                  <div class="form-group">
                    <label for="noofcredits">No. Of Credits </label>
                    <input type="text" class="form-control" id="noofcredits" name="noofcredits" placeholder="Enter No. Of Credits" required />
                  </div>

                  <div class="form-group">
                    <label for="location">Location </label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" required />
                  </div>
                  <div class="form-group">
                    <label for="level">Level </label>
                    <input type="text" class="form-control" id="level" name="level" placeholder="Enter Level" required />
                  </div>
                  <div class="form-group">
                    <label for="startdate">Start Date </label>
                    <input type="text" class="form-control" id="startdate" name="startdate" placeholder="Enter Start Date" required />
                  </div>
                  <div class="form-group">
                    <label for="enddate">End Date </label>
                    <input type="text" class="form-control" id="enddate" name="enddate" placeholder="Enter End Date" required />
                  </div>
                  <div class="form-group">
                    <label for="instructor">Instructor </label>
                    <input type="text" class="form-control" id="instructor" name="instructor" placeholder="Enter Instructor" required />
                  </div>
                  <button type="submit" name="submit" class="btn btn-default">Submit</button>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    </div>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>

  </html>
<?php } ?>