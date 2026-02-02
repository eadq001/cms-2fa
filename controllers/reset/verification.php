<?php
declare(strict_types=1);
use Core\Email\Email;
use Core\Mailer\Mailer;

$mailer = new Mailer();
$email = $_POST['email'];

$user = Email::isEmailExist($email);

$mailer->send

if ($user) {
    redirect('/password_reset');
}


?>