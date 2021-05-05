<?php
session_start();
include('config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
  $regid=$_SESSION['login'];
if(isset($_POST['submit']))
{
$studentname=$_POST['studentname'];
$studentemail=$_POST['studentemail'];
$studentmobile=$_POST['studentmobile'];

$cgpa=$_POST['cgpa'];

$ret=mysqli_query($con,"update students set studentName='$studentname',studentEmail='$studentemail',studentMobile='$studentmobile',cgpa='$cgpa'  where StudentRegno='$regid'");
if($ret)
{
$_SESSION['msg']="Your Profile updated Successfully !!";
}
else
{
  $_SESSION['msg']="Error : Your Profile not updated!";
}
}
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>My Profile</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('userheader.php');?>
<?php if($_SESSION['login']!="")
{
 include('usermenubar.php');
}
 ?>
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">My Profile</h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Edit profile
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
<?php 

$sql=mysqli_query($con,"select * from students where StudentRegno='$regid'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{ ?>

                        <div class="panel-body">
                       <form name="dept" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="studentregno">User ID / Reg No   </label>
    <input type="text" class="form-control" id="studentregno" name="studentregno" value="<?php echo htmlentities($row['StudentRegno']);?>"  readonly />
    </div>

   <div class="form-group">
    <label for="studentname">Name  </label>
    <input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo htmlentities($row['studentName']);?>"  />
  </div>

 <div class="form-group">
    <label for="studentemail">Email  </label>
    <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" class="form-control" id="studentemail" name="studentemail"  value="<?php echo htmlentities($row['studentEmail']);?>" required />
  </div>  
  <div class="form-group">
    <label for="studentmobile">Mobile  </label>
    <input type="text" class="form-control" id="studentmobile" name="studentmobile" maxlength="10" value="<?php echo $row['studentMobile'];?>" required />
  </div> 
<div class="form-group">
    <label for="CGPA">CGPA  </label>
    <input type="text" class="form-control" id="cgpa" name="cgpa"  value="<?php echo htmlentities($row['cgpa']);?>" readonly />
  </div>  

 </div>
<?php } ?>

 <button type="submit" name="submit" id="submit" class="btn btn-default">Update</button>
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
