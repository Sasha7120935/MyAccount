<?php

namespace Classes;

class Pdf
{
    public static function getPdf($age, $email, $surname, $name, $photo)
    {

        require 'vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();
        $data = "";
        $data .= "<h1>User</h1>";
        $data .= "<string>Name:</string>" . $name . "<br>";
        $data .= "<string>Surname:</string>" . $surname . "<br>";
        $data .= "<string>Email:</string>" . $email . "<br>";
        $data .= "<string>Age:</string>" . $age . "<br>";
        $data .= "<img src=". $photo ." width='90'/></img>";
        $mpdf->WriteHTML($data);
        $mpdf->Output("data.pdf", "D");
    }

}