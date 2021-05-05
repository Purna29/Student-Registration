<?php
session_start();
include('config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
  header('location:login.php');
} else {

?>
  <!DOCTYPE html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>My Courses</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <?php include('userheader.php'); ?>
    <?php if ($_SESSION['login'] != "") {
      include('usermenubar.php');
    }
    ?>
    <div class="content-wrapper">
      <div class="container">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <h1 class="page-head-line">Courses Completed list</h1>
            </div>
          </div>
          <div class="row">
            <?php $sql = mysqli_query($con, "select course.course, course.courseName, course.instructor, courseenrolls.completedDate from courseenrolls, course WHERE course.id=courseenrolls.course AND courseenrolls.status = 'C' AND courseenrolls.studentRegno = " . $_SESSION['login']);
            $cnt = 0;
            while ($row = mysqli_fetch_array($sql)) {

            ?>
              <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                  <div class="card-header"><?php echo $row['course']; ?></div>
                  <div class="card-body">
                    <h1 class="card-title"><?php echo $row['courseName']; ?></h1>
                    <p class="card-text"><?php echo $row['instructor']; ?></p>
                  </div>
                  <div class="card-footer">Completed on <?php echo $row['completedDate']; ?></div>
                </div>
              </div>
            <?php
              $cnt++;
            } ?>
            <?php if ($cnt == 0) { ?>
              <div class="col-md-auto">You don't have any completed courses</div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>

  </body>

  </html>
<?php } ?>