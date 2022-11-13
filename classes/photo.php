<?php

namespace Classes;

class Photo
{
    public static function validationPhoto(array $photo)
    {
        $fileUpload = pathinfo($photo["name"], PATHINFO_EXTENSION);
        $fileSize = $photo["size"];
        $allowed_image_extension = ["png", "jpg"];
//        $fileInfo = @getimagesize($photo["photo"]["tmp_name"]);
        if (!in_array($fileUpload, $allowed_image_extension)) {
            echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . 'Upload images. Only PNG and JPG are allowed.' . '<p/>';
            exit;
        }
        if ($fileSize > 100000) {
            echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . 'Image size exceeds 1MB' . '<p/>';
            exit;
        }
    }

}