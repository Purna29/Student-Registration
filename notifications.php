<?php
session_start();
include('config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_GET['del']))
      {
              mysqli_query($con,"delete from notifications where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Notification record deleted !!";
      }
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Admin | Notification</title>
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
                        <h1 class="page-head-line">Notifications  </h1>
                    </div>
                </div>
                <div class="row" >
                 
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Of Notifications
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Message </th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select * from notifications where active='Y' order by creationdate desc");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
     <tr>
          <td><?php echo $cnt;?></td>
          <td><?php echo htmlentities($row['title']);?></td>
           <td><?php echo htmlentities($row['message']);?></td>
     </tr>
<?php 
$cnt++;
} ?>                                       
                                    </tbody>
                                </table>
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
