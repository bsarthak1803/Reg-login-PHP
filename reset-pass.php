<?php
if(isset($_POST["reset_pwd"]))
{
  $selector=$_POST["sel"];
  $validator=$_POST["val"];
  $password=$_POST["pwd"];
  $password_repeat=$_POST["pwd_repeat"];
  echo $selector;
  if(empty($password) || empty($password_repeat))
  {
    header("location:new-password.php?newpd=empty");
    exit();
  }
  else if($password!=$password_repeat)
  {
    header("location:new-password.php?newpd=pwdnotsame");
    exit();
  }
  $current_date=date("U");

  $servername = "localhost";
  $username = "root";
  $pass = "";
  $db="associate";

  //connection sql
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username,$pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
  }
  catch(PDOException $e)
  {
    echo "Connection failed: " . $e->getMessage();
  }

  try{
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo $current_date;
    $stmt = $conn->prepare("SELECT * FROM pwdreset where selector='$selector' AND expires >='$current_date'");
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $stmt->rowCount();
    if ($stmt->rowCount()) {
      $tokenbin=hex2bin($validator);
      $tokencheck=password_verify($tokenbin,$res["token"]);
      //echo $tokencheck;
      if($tokencheck===false){
        echo "you need to resubmit the form";
        exit();
      }
      else if($tokencheck===true)
      {
        try{
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $tokenemail=$res["email"];

          $stmt = $conn->prepare("SELECT * FROM employee where email='$tokenemail'");
          $stmt->execute();
          $res1 = $stmt->fetch(PDO::FETCH_ASSOC);

          if ($stmt->rowCount())
          {
            $newhash=password_hash($password,PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE employee SET password='$newhash' where email='$tokenemail'");
            $stmt->execute();

            $stmt = $conn->prepare("DELETE FROM pwdreset where email='$tokenemail'");
            $stmt->execute();
            header("location:index.php?newpwd=passwordupdated");
          }
        }
        catch(PDOException $e)
        {
          echo "Connection failed: " . $e->getMessage();
        }
      }else{
        echo 'hii you need to resubmit your reset request';
        exit();
      }
    }
  }

  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

}
else
header("location:index.php");

?>
