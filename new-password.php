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
</head>

<body>
  <div class="row bg-img">
    <div class="col-sm-6">
      <h2 style="margin-left:10%; margin-top:10%; color:white">New password form</h2>
      <?php
      @$selector=$_GET["selector"];
      @$validator=$_GET["validator"];

      ?>

      <form id="reset" action="reset-pass.php" method="POST" class="cont" style="margin-top:8%;">


        <input type="hidden" value="<?php echo $selector?>" name="sel" >
        <input type="hidden" value="<?php echo $validator?>" name="val" >
        <input type="password" class="form-control" id="pwd1"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter password(min 8 characters)" name="pwd" required>
        <input type="password" class="form-control" id="pwd2"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter password(min 8 characters)" name="pwd_repeat" required>

        <input type="submit" name="reset_pwd" class="btn btn-success btn-lg" style="width:100%; margin-top:10%;" ></button>


      </form>
      <?php

      if(empty($selector) || empty($validator))
      {
        echo "We could not validate your request";
      }
      ?>
    </div>
    <div class="col-sm-6"></div>
  </div>
  <!-- register modal -->
</body>
</html>
