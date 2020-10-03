<?php
$servername = "localhost";
$username = "root";
$password="";
$db="associate";
$cid=$_POST["cid"];
$pass=$_POST["psw"];

//connection sql
try {
  $conn = new PDO("mysql:host=$servername;dbname=$db", $username,$password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
}
catch(PDOException $e)
{
  echo "Connection failed: " . $e->getMessage();
}

//cernerid matching sql
try{
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("select * from employee where cernerid='$cid'");
  $stmt->execute();
  $count=$stmt->rowCount();
  //fetch rows with cernerid in associative array
  $result =$stmt->fetch(PDO::FETCH_ASSOC);
  $hash=password_verify($pass,$result['password']);
  if(password_verify($pass,$result['password']) && $count>0)
  {
    //session starts//
    session_start();
    $_SESSION["cern"]=$cid;
    header("location:account.php");
    exit();
  }
  else
  {
    echo '<script> alert("wrong cernerid/password")
    window.location="index.php";
    </script>';
  }
}

catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>
