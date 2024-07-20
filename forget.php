<?php
include("connect.php");
include("query.php");

$resetemail = $_POST['email'];

function generateRandomPassword($length = 5)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\ricevents\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\ricevents\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\ricevents\PHPMailer\src\SMTP.php';

$mail = new PHPMailer(true);

$sql = "SELECT * FROM users WHERE email='$resetemail'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'webdev.cite@gmail.com';
        $mail->Password = 'iwxeehexxorczpcn';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $row = $result->fetch_assoc();
        $tempPassword = generateRandomPassword();
        $hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);
        $updatePasswordQuery = "UPDATE users SET Password='$hashedPassword' WHERE email='$resetemail'";
        mysqli_query($con, $updatePasswordQuery);

        $mail->setFrom('webdev.cite@gmail.com', 'Ric Events');
        $mail->addAddress($resetemail, '');

        $message = '
        <html>
        <body>
            <p>Dear Sir/Madam,</p>
            <p>We have reset your temporary password. Please use the following temporary password to log in:</p>
            <p><strong>Temporary Password: ' . $tempPassword . '</strong></p>
            <p>For your security, we recommend changing your password immediately after logging in.</p>
            <p>If you did not request a password reset, please contact our support team immediately.</p>
            <p>Thank you,<br>
            Ric Events Management Team</p>
        </body>
        </html>
    ';
        $mail->isHTML(true);
        $mail->Subject = 'Temporary Password Reset - Ric Events Library Account';
        $mail->Body = $message;
        $mail->AltBody = 'Dear Sir/Madam, Your temporary password has been reset. Temporary Password: ' . $tempPassword . '. For your security, please change your password immediately after logging in. If you did not request a password reset, please contact our support team immediately. Thank you, Ric Events Management Team';
        $mail->send();

        echo '<script>alert("Temporary password sent to your email!");</script>';
        echo '<script>window.location.href = "landingpage.php";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "<script>alert('User with this email does not exist');</script>";
    echo '<script>window.history.back();</script>';
}
