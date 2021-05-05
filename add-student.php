<?php
session_start();
include('config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {

  if (isset($_POST['submit'])) {
    $studentname = $_POST['studentname'];
    $studentregno = $_POST['studentregno'];
    $studentemail = $_POST['studentemail'];
    $studentmobile = $_POST['studentmobile'];
    $ret = mysqli_query($con, "insert into students(studentName, StudentRegno, studentEmail, studentMobile) values('$studentname', '$studentregno', '$studentemail', '$studentmobile')");
    if ($ret) {
      $_SESSION['msg'] = "Student Registered Successfully !!";
    } else {
      $_SESSION['msg'] = "Error : Student  not Register";
    }
  }
?>

  <!DOCTYPE html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Admin | Student</title>
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
            <h1 class="page-head-line">Student Registration </h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                Student Registration
              </div>
              <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>


              <div class="panel-body">
                <form name="dept" method="post">
                  <div class="form-group">
                    <label for="studentname">Student Name </label>
                    <input type="text" class="form-control" id="studentname" name="studentname" placeholder="Student Name" required />
                  </div>

                  <div class="form-group">
                    <label for="studentemail">Student Email </label>
                    <input type="text" class="form-control" id="studentemail" name="studentemail" placeholder="Student Email" required />
                  </div>
                  <div class="form-group">
                    <label for="studentmobile">Student Mobile </label>
                    <input type="number" class="form-control" id="studentmobile" name="studentmobile" maxlength="10" placeholder="Student Mobie No" required />
                  </div>

                  <div class="form-group">
                    <label for="studentregno">Student Reg No </label>
                    <input type="text" class="form-control" id="studentregno" name="studentregno" onBlur="userAvailability()" placeholder="Student Reg no" required />
                    <span id="user-availability-status1" style="font-size:12px;">
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
    <script>
      function userAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
          url: "check_availability.php",
          data: 'regno=' + $("#studentregno").val(),
          type: "POST",
          success: function(data) {
            $("#user-availability-status1").html(data);
            $("#loaderIcon").hide();
          },
          error: function() {}
        });
      }
    </script>


  </body>

  </html>
<?php } ?>