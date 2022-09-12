<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

function sendEmailConfirmation($to, $token)
{
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPSecure = "ssl";
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = 'gmail@gmail.com';
    $mail->Password = 'privasi_boskuh';
    $mail->addAddress($to);
    $mail->Subject = 'Email Confirmation';
    $mail->Body = "Hey you can confirm your account using this token : {$token}";

    if (!$mail->send()) {
        return false;
    }


    return true;
}
