<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // jika pakai Composer
// atau jika manual upload PHPMailer
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';
// require 'PHPMailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST["name"]);
  $email = htmlspecialchars($_POST["email"]);
  $message = htmlspecialchars($_POST["message"]);

  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'annuraldebaran@gmail.com'; // emailmu
    $mail->Password   = 'YOUR_APP_PASSWORD'; // Ganti dengan App Password Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // atau 'tls'
    $mail->Port       = 465; // 587 jika TLS

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('annuraldebaran@gmail.com'); // tujuan sama dengan pengirimmu

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New message from CV Website Contact Form';
    $mail->Body    = "
      <b>Name:</b> {$name}<br>
      <b>Email:</b> {$email}<br>
      <b>Message:</b><br>{$message}
    ";

    $mail->send();
    echo "<script>alert('Message sent successfully!'); window.location.href='index.html';</script>";
  } catch (Exception $e) {
    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}'); window.location.href='index.html';</script>";
  }
}
?>
