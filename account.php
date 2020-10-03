<?php
session_start();
if(!isset($_SESSION["cern"]))
{
  header("location: index.php");
}
$id=$_SESSION["cern"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <title>Account</title>
  <link rel="stylesheet" href="index.css"
</head>
<body>
  <div class="row bg-img">
    <h2 style="color:white;margin-left:5%;margin-top:4%;">SMILE! YOU ARE ONBOARD WITH CERNER-HAVE A HAPPY JOURNEY</h2>
    <div class="col-sm-4"></div>
    <div class="col-sm-4">

      <p style="color:white; margin-top:10%;">WE AT CERNER VALUES EACH AND EVERY EMPLOYEE ESPECIALLY THE ONE WITH CERNER-ID <?php echo $id."<br>"?></p>
      <a href="logout.php"><button style="margin-top:30px; margin-left:40%;" class="btn btn-info"><i class="fa fa-sign-out-alt"></i> Logout</button></a>
    </div>
    <div class="col-sm-4"></div>
  </div>
</body>
</html>
