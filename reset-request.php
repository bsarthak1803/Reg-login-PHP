<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../php/pear/PEAR/src/Exception.php';
require '../../php/pear/PEAR/src/PHPMailer.php';
require '../../php/pear/PEAR/src/SMTP.php';

$mail = new PHPMailer();

if(isset($_POST["reset-request"]))
{
  $sel=bin2hex(random_bytes(8));
  $token=random_bytes(32);
  $url="localhost/Sample_project/new-password.php?selector=" . $sel ."&validator=". bin2hex($token);
  $expires=date("U")+1800;
  $servername = "localhost";
  $username = "root";
  $pass = "";
  $db="associate";

  //connection sql
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username,$pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  }
  catch(PDOException $e)
  {
    echo "Connection failed: " . $e->getMessage();
  }
  $email=$_POST["eid"];

  $stmt = $conn->prepare("SELECT * from employee where email='$email'");
  $stmt->execute();
  if($stmt->rowCount())
  {
    $stmt = $conn->prepare("DELETE FROM pwdreset where email='$email'");
    $stmt->execute();


    $stmt = $conn->prepare("INSERT INTO pwdreset (email, selector, token, expires)
    VALUES (:email, :selector, :token, :expires)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':selector', $sel);
    $hashed_token=password_hash($token,PASSWORD_BCRYPT);
    $stmt->bindParam(':token', $hashed_token);
    $stmt->bindParam(':expires', $expires);
    $stmt->execute();


    $conn=null;

    //phpmailer script with mailer object
    $mail->isSMTP(true);                            // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';             // Specify  servers
    $mail->SMTPAuth = true;                     // Enable SMTP authentication
    $mail->Username = 'sarthak.bhardwaj@gmail.com';          // SMTP username
    $mail->Password = 'sarthakryan'; // SMTP password
    $mail->SMTPSecure = 'tls';                  // Enable TLS encryption
    $mail->Port = 587;                          // TCP port


    $mail->setFrom('sarthak.bhardwaj@gmail.com', 'sarthak');
    $mail->addReplyTo('sarthak.bhardwaj@gmail.com', 'sarthak');
    $mail->addAddress($email);   // Add a recipient

    $mail->isHTML(true);  // Set email format to HTML

    $bodycontent = '<p>we received a password reset request</p>';
    $bodycontent.='<p>your reset link is: </br></p>';
    $bodycontent.='<a href="' .$url. '">' . $url . '</a></p>';
    $mail->Subject = 'Email from Localhost by sarthak';
    $mail->Body    = $bodycontent;

    if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
      echo 'Message has been sent';
      header("location:forgot.php?reset=success");
    }
  }
  else
  {
    header("location:forgot.php?reset=failed");
    exit();
  }

}
else
{
  header("location:index.php");
}
?>
