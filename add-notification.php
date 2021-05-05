<?php
session_start();
include('config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {

  if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];
    $ret = mysqli_query($con, "insert into notifications(title,message) values('$title','$message')");
    if ($ret) {
      $_SESSION['msg'] = "Notification created Successfully !!";
    } else {
      $_SESSION['msg'] = "Error : Notification  not Created!!";
    }
  }
?>

  <!DOCTYPE html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Admin | Notfication</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <?php include('adminheader.php'); ?>
    <?php if ($_SESSION['alogin'] != "") {
      include('adminmenubar.php');

      $studentSql = mysqli_query($con, "select StudentRegno, studentName from students");
    }
    ?>
    <div class="content-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-head-line">Add Notification </h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                Add Notification
              </div>
              <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>


              <div class="panel-body">
                <form name="dept" method="post">
                  <div class="form-group">
                    <label for="studentname">Title </label>
                    <input type="text" name="title" id="title" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="message">Message </label>
                    <textarea class="form-control" id="message" name="message" rows="8" cols="50"></textarea>
                  </div>

                  <button type="submit" name="submit" id="submit" class="btn btn-default">Submit</button>
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