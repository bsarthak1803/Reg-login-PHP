<?php include("register.php");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="index.css">
  <script src="script.js"></script>
  <script type="text/javascript">
  function checkDOB() {
    var dateString = document.getElementById('birth').value;
    //alert(dateString);
    var myDate = new Date(dateString);
    var today = new Date();
    if ( myDate > today ) {
      document.getElementById("para").innerHTML = "Date cannot be in the future!";
      document.getElementById("para").style.color = "red";
      return false;
    }
    else
    {
      document.getElementById("para").innerHTML = "Correct date";
      document.getElementById("para").style.color = "green";
      return true;
    }
  }
  </script>
</head>

<body>
  <div class="bg-img">
    <form id="formid" action="login.php" method="POST" class="cont" style="margin-top:8%;">
      <h2 style="margin-left:6%; color:white">Existing Associate</h2>

      <input type="text" placeholder="Enter Cerner id" name="cid" required>
      <input type="password" placeholder="Enter Password" name="psw" required>
      <?php
      if(isset($_GET["newpwd"]))
      {
        if(($_GET["newpwd"])=="passwordupdated")
        {
          echo '<p class="signupsuccess" style="color:white;">your password has been reset!</p>';
        }
      }
      ?>
      <a href="forgot.php" class="btn btn-link" style="margin-top:-20px;">forgot password?</a>
      <button type="submit" class="btn btn-success btn-lg" style="width:100%; margin-top:10%;" > Login </button>
      <button type="button" class="btn btn-danger btn-lg" style="margin-top:10%; width:100%" data-toggle="modal" data-target="#reg"> New Associate </button>


    </form>
  </div>
  <!-- register modal -->

  <div id="reg" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
        <div class="modal-body" style="background-color:#add8e6">
          <h2 style="margin-left:10%">WELCOME NEW ASSOCIATE</h1>
            <form id="fid" action="">
              <div id="error_msg"></div>
              <div class="form-group">
                <label for="fname"></label>
                <input type="text" class="form-control" id="fnm" placeholder="Enter first name" name="fname">
                <label for="lname"></label>
                <input type="text" class="form-control" id="lnm" placeholder="Enter last name" name="lname">
                <label for="dob"></label>
                <input type="date" class="form-control" id="birth" placeholder="Enter dob" name="dob" oninput="checkDOB()">
                <p id="para"></p>
                <label for="address"></label>
                <textarea class="form-control" id="addr" placeholder="Enter your address" name="add"></textarea>
                <label for="Ph number"></label>
                <input type="text" class="form-control" id="ph" placeholder="Enter contact number" pattern="[0-9]{10}" title="10 digit mobile number" name="phnum">
                <div>
                  <label for="email"></label>
                  <input type="email" class="form-control" id="em" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$"  title="eg.abc@sd.com" placeholder="Enter email" name="email" required>
                  <label for="pwd"></label>
                  <span style="margin-top:2%;"></span>
                </div>
                <input type="password" class="form-control" id="pwd"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter password(min 8 characters)" name="pswd" required>
              </div>

              <button  type="submit" class="btn btn-success" style="margin-left: 40%; width:20%">Register</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </body>
  </html>
