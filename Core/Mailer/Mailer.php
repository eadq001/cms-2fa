<?php declare(strict_types=1);

namespace Core\Mailer;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

use const Mailer\gmail;
use const Mailer\passing;

class Mailer
{

    public function send($email, $username, $code = null, $token = null)
    {
        // Create an instance; passing `true` enables exceptions

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output
            $mail->isSMTP();  // Send using SMTP
            $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
            $mail->SMTPAuth = true;  // Enable SMTP authentication
            $mail->Username = $_ENV['SMTP_EMAIL'];  // SMTP username
            $mail->Password = $_ENV['SMTP_PASSWORD'];  // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // Enable implicit TLS encryption
            $mail->Port = 465;  // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom($_ENV['SMTP_EMAIL'], 'CMS-2FA');
            $mail->addAddress($email, $username);  // Add a recipient

            // Content
            if (!empty($code)) {
                $mail->Subject = 'OTP Code';
                $mail->Body = "This is your code <b> {$code} </b>";
            }
            else {
                $mail->Subject = 'Password reset';
                $mail->Body = "This is your password reset link <a href='/password_reset?token={$token}'>Reset Your Password</a>";
            }

            $mail->send();

            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
