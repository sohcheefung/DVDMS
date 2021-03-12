<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require_once("dbconnect.php");
$con= Createdb();

if(isset($_POST['submit'])){
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $query = "SELECT*from users WHERE email='$email'";
  $run = mysqli_query($con,$query);
  if(mysqli_num_rows($run)>0){
    $row = mysqli_fetch_array($run);
    $db_email = $row['email'];
    $db_id = $row['id'];
    $token = uniqid(md5(time())); // unique random token
    $query = "INSERT INTO password_reset(id,email,token) VALUES(NULL,'$email','$token')";
    if(mysqli_query($con,$query)){
      //$to = $db_email;
      //$subject = "Password reset link";
      $message = "Click <a href='http://localhost/DVDMS/reset.php?token=$token'>here</a> to reset your password.";
      //$headers = "MIME-Version: 1.0"."\r\n";
      //$headers = "Content-type:text/html;charset=UTF-8"."\r\n";
      //$headers = 'From:<demo@demo.com>'."\r\n";
      //mail($to,$subject,$message,$headers);
      $mail = new PHPMailer(true);
      try {
          //Server settings
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'sohcheefung@gmail.com';
          $mail->Password = 'Madarauchiha123#';
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587; // Can be 587

          //Recipients
          $mail->setFrom('sohcheefung@gmail.com', 'DVDMS');
          $mail->addAddress($db_email);     //Add a recipient
          $mail->addReplyTo('no-reply@gmail.com', 'No reply');

          //Content
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Password reset link';
          $mail->Body    = $message;
          //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

          $mail->send();
          header("Location: ../forgotpassword.php?success=Password reset link has been sent to your email.");
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

}


}else{
    header("Location: ../forgotpassword.php?error=User not found!");
  }
}else{
    header("Location: ../forgotpassword.php?error=User not found!");
}
}else{
  header("Location: ../forgotpassword.php?error=User not found!");
}





 ?>
