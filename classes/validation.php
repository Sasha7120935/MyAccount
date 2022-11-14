<?php

namespace Classes;

use Imagecow\Image;

class Validation
{
    public static function validationPhoto(array $photo)
    {
        $fileUpload = pathinfo($photo["name"], PATHINFO_EXTENSION);
        $fileSize = $photo["size"];
        $allowed_image_extension = ["png", "jpg", "jpeg"];
//        $fileInfo = @getimagesize($photo["tmp_name"]);
//        $width = $fileInfo[0];
//        $height = $fileInfo[1];
        if (!in_array($fileUpload, $allowed_image_extension)) {
            echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . 'Upload images. Only PNG and JPG are allowed.' . '<p/>';
            exit;
        }
        if ($fileSize > 100000) {
            echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . 'Image size exceeds 1MB' . '<p/>';
            exit;
        }
    }

    public static function validationEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email format';
            exit;
        }
    }

    public static function validationAge($age)
    {
        if ($age < 18) {
            echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . '18+' . '<p/>';
            exit;
        }
    }

}