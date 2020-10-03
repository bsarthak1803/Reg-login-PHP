<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../php/pear/PEAR/src/Exception.php';
require '../../php/pear/PEAR/src/PHPMailer.php';
require '../../php/pear/PEAR/src/SMTP.php';

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

//emailcheck sql
try{
  if (isset($_POST['email_check'])) {
    $email = $_POST['email'];
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT email FROM employee where email='$email'");
    $stmt->execute();
    if ($stmt->rowCount()) {
      echo "taken";
    }else{
      echo 'not_taken';
    }
    exit();
  }
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

//insertion sql
try{
  if (isset($_POST['save'])) {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $add = $_POST['add'];
    $phone = $_POST['phnum'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = $_POST['pswd'];
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT email FROM employee where email='$email'");
    $stmt->execute();
    if ($stmt->rowCount()) {
    echo "exists";
      exit();
    }else{
      $stmt = $conn->prepare("INSERT INTO employee (firstname, lastname,dob, addresss, phnum, email, password)
      VALUES (:firstname, :lastname, :dob, :addresss, :phnum, :email, :password)");
      $stmt->bindParam(':firstname', $firstname);
      $stmt->bindParam(':lastname', $lastname);
      $stmt->bindParam(':dob', $dob);
      $stmt->bindParam(':addresss', $add);
      $stmt->bindParam(':phnum', $phone);
      $stmt->bindParam(':email', $email);
      $hash= password_hash($password, PASSWORD_BCRYPT);
      $stmt->bindParam(':password', $hash);
      $stmt->execute();
      $stmt = $conn->prepare("SELECT cernerid FROM employee where email='$email'");
      $stmt->execute();
      $res = $stmt->fetch(PDO::FETCH_ASSOC);


      $mail = new PHPMailer();
      $mail->isSMTP(true);                            // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                     // Enable SMTP authentication
      $mail->Username = 'sarthak.bhardwaj@gmail.com';          // SMTP username
      $mail->Password = 'sarthakryan'; // SMTP password
      $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                          // TCP port to connect to


      $mail->setFrom('sarthak.bhardwaj@gmail.com', 'sarthak');
      $mail->addReplyTo('sarthak.bhardwaj@gmail.com', 'sarthak');
      $mail->addAddress($email);   // Add a recipient

      $mail->isHTML(true);  // Set email format to HTML

      $bodycontent = '<p>Hii new associate! Welcome to Cerner.Your cerner-id is</p>'. $res['cernerid'];
      $mail->Body    = $bodycontent;
      $mail->send();

      echo $res['cernerid'];
      exit();
    }
  }
}

catch(PDOException $e)
{
  echo "Error: " . $e->getMessage();
}
$conn = null;


?>
