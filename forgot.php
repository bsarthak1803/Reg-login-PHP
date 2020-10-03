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
      <h2 style="margin-left:10%; margin-top:20%; color:white;">ENTER EMAIL-ID TO RECEIVE LINK</h2>
      <form id="forgot" action="reset-request.php" method="POST" class="cont" style="margin-top:2%;margin-left:8%;">


        <input type="text" placeholder="Enter emailid" name="eid" required>

        <button type="submit" name="reset-request" class="btn btn-success btn-lg" style="width:100%; margin-top:10%;" > RECEIVE LINK </button>


        <?php
        if(isset($_GET["reset"]))
        {
          if($_GET["reset"]=="success")
          {
            echo '<p class="signupsuccess" style="margin-left:20%; margin-top:5%;color:white;">check your email!</p>';
          }
          else if($_GET["reset"]=="failed")
          {
            {
              echo '<p class="signupsuccess" style="margin-left:20%; margin-top:5%;color:white;">Enter a valid email-id</p>';
            }
          }
        }
        ?>

      </form>
    </div>
    <div class="col-sm-6"></div>
  </div>
  <!-- register modal -->
</body>
</html>
