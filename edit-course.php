<?php
session_start();
include('config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  $id = intval($_GET['id']);
  date_default_timezone_set('Asia/Kolkata');
  $currentTime = date('d-m-Y h:i:s A', time());
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
    $ret = mysqli_query($con, "update course set CRN='$crn', course='$course', courseName='$coursename', noOfCredits='$noofcredits', location='$location', level='$level', startDate='$startdate', endDate='$enddate', instructor='$instructor' where id='$id'");
    if ($ret) {
      $_SESSION['msg'] = "Course Updated Successfully !!";
    } else {
      $_SESSION['msg'] = "Error : Course not Updated";
    }
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
                Edit Course
              </div>
              <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>


              <div class="panel-body">
                <form name="dept" method="post">
                  <?php
                  $sql = mysqli_query($con, "select * from course where id='$id'");
                  $cnt = 1;
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                    <p><b>Last Updated at</b> :<?php echo htmlentities($row['updationDate']); ?></p>

                    <div class="form-group">
                      <label for="crn">CRN </label>
                      <input type="text" class="form-control" id="crn" name="crn" placeholder="Enter CRN" value="<?php echo htmlentities($row['CRN']); ?>" required />
                    </div>
                    <div class="form-group">
                      <label for="course">Course </label>
                      <input type="text" class="form-control" id="course" name="course" placeholder="Enter Course" value="<?php echo htmlentities($row['course']); ?>" required />
                    </div>

                    <div class="form-group">
                      <label for="coursename">Course Name </label>
                      <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Enter Course Name" value="<?php echo htmlentities($row['courseName']); ?>" required />
                    </div>

                    <div class="form-group">
                      <label for="noofcredits">No. Of Credits </label>
                      <input type="text" class="form-control" id="noofcredits" name="noofcredits" placeholder="Enter No. Of Credits" value="<?php echo htmlentities($row['noofCredits']); ?>" required />
                    </div>

                    <div class="form-group">
                      <label for="location">Location </label>
                      <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" value="<?php echo htmlentities($row['location']); ?>" required />
                    </div>
                    <div class="form-group">
                      <label for="level">Level </label>
                      <input type="text" class="form-control" id="level" name="level" placeholder="Enter Level" value="<?php echo htmlentities($row['level']); ?>" required />
                    </div>
                    <div class="form-group">
                      <label for="startdate">Start Date </label>
                      <input type="text" class="form-control" id="startdate" name="startdate" placeholder="Enter Start Date" value="<?php echo htmlentities($row['startDate']); ?>" required />
                    </div>
                    <div class="form-group">
                      <label for="enddate">End Date </label>
                      <input type="text" class="form-control" id="enddate" name="enddate" placeholder="Enter End Date" value="<?php echo htmlentities($row['endDate']); ?>" required />
                    </div>
                    <div class="form-group">
                      <label for="instructor">Instructor </label>
                      <input type="text" class="form-control" id="instructor" name="instructor" placeholder="Enter Instructor" value="<?php echo htmlentities($row['instructor']); ?>" required />
                    </div>


                  <?php } ?>
                  <button type="submit" name="submit" class="btn btn-default"><i class=" fa fa-refresh "></i> Update</button>
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