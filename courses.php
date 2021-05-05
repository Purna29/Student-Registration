<?php
session_start();
include('config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {

?>
  <!DOCTYPE html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Course List</title>
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
              <h1 class="page-head-line">Course List </h1>
            </div>
          </div>
          <div class="row">
            <?php $sql = mysqli_query($con, "select * from course");
            $i = 0;
            while ($row = mysqli_fetch_array($sql)) {
              $sql2 = mysqli_query($con, "select *  from courseenrolls where course=" . $row['id'] . "  and studentRegno = " . $_SESSION['login']);
              $res = mysqli_fetch_array($sql2);
              if ($res['status'] == 'E') {
                $bgclass = 'bg-primary';
              } else  if ($res['status'] == 'C') {
                $bgclass = 'bg-success';
              } else if ($res['status'] == 'F') {
                $bgclass = 'bg-danger';
              } else {
                $bgclass = 'bg-info';
              }
            ?>
              <div class="col-md-4">
                <div class="card text-white <?php echo $bgclass; ?> mb-3">
                  <div class="card-header"><?php echo $row['course']; ?></div>
                  <div class="card-body">
                    <h1 class="card-title"><?php echo $row['courseName']; ?></h1>
                    <p class="card-text"><?php echo $row['instructor']; ?></p>
                    <?php if ($res['status'] == 'E') { ?>
                      <p class="card-text">Enroll on <?php echo $res['enrollDate']; ?></p>
                      <?php } else if ($res['status'] == 'F') { ?>
                      <p class="card-text">Failed on <?php echo $res['failedDate']; ?></p>
                    <?php }else{ ?>
                      <p class="card-text">&nbsp;</p>
                      <?php } ?>
                  </div>
                  <?php if ($res['status'] == 'E') { ?>
                  <div class="card-footer">
                    <a href="update-course.php?id=<?php echo $row['id']; ?>&status=F">
                        <button class="btn btn-danger w-45">Failed</button>
                      </a>
                    <a href="update-course.php?id=<?php echo $row['id'];?>&status=C">
                      <button class="btn btn-success w-45">Completed</button>
                    </a>
                  </div>
                <?php } else if ($res['status'] == 'C') { ?>
                   
                  <div class="card-footer"> Completed on <?php echo $res['completedDate']; ?></div>
                <?php } else if ($res['status'] == 'F') { ?>
                    
                  <div class="card-footer">
                    <a href="update-course.php?id=<?php echo $row['id'];?>&status=R">
                      <button class="btn btn-primary w-100">Re-Attampt</button>
                    </a>
                  </div>
                <?php }else{ ?>
                  <div class="card-footer">
                    <a href="update-course.php?id=<?php echo $row['id'];?>&status=E">
                      <button class="btn btn-primary w-100">Select</button>
                    </a>
                  </div>
                <?php } ?>
                </div>
              </div>
            <?php $i++;
            } ?>
            
          </div>
        </div>
      </div>
    </div>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>

  </body>

  </html>
<?php } ?>