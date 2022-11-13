<?php


namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    public static function sentMail($age, $email, $surname, $name)
    {
        require 'vendor/autoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'test@gmail.com';
        $mail->Password = '****************';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('test@gmail.com', 'Alex');
        $mail->addReplyTo('test@gmail.com', 'Alex');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'New User';
        $bodyContent = 'Dear:' . $name;
        $bodyContent .= '<p>' . $name.'<br>'. $surname. '<br>'. $age . '</p>';
        $mail->Body = $bodyContent;
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        return $mail;

    }

}
