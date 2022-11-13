<?php include 'connection.php'; ?>
    <!DOCTYPE html>
    <html lang="en-US">
    <head>
        <title>Project</title>
        <link rel="stylesheet" href="libs/css/bootstrap.min.css">
        <link rel="stylesheet" href="libs/style.css">
    </head>
    <div class="reg-input-field">
        <h3>Create Account</h3>
        <form method="post" action="#" enctype="multipart/form-data">
            <div class="form-group">
                <label>Photo</label>
                <input type="file" class="form-control" id=photo name="photo" style="width:20em;">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="user" style="width:20em;"
                       placeholder="Enter your Username">
            </div>
            <div class="form-group">
                <label>Surname</label>
                <input type="text" class="form-control" name="surname" style="width:20em;"
                       placeholder="Enter your Surname">
            </div>
            <div class="form-group">
                <label>Age</label>
                <input type="number" class="form-control" name="age" style="width:20em;" placeholder="Enter your Age">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="email" name="email" style="width:20em;"
                       placeholder="Enter your Email">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Save" class="btn btn-primary submitBtn"
                       style="width:20em; margin:0;"/><br><br>
                <center>
                    <a href="index.php">Back to Home</a>
                </center>
            </div>
        </form>
    </div>
    </html>
<?php
if (isset($_FILES['photo'])) {
    $photo = $_FILES['photo'];
    $fileUpload = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
    $fileSize = $_FILES["photo"]["size"];
    $allowed_image_extension = ["png", "jpg"];
    $fileInfo = @getimagesize($_FILES["photo"]["tmp_name"]);
    if (!in_array($fileUpload, $allowed_image_extension)) {
        echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . 'Upload images. Only PNG and JPG are allowed.' . '<p/>';
        exit;
    }
    if ($fileSize > 100000) {
        echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . 'Image size exceeds 1MB' . '<p/>';
        exit;
    } else {
        $target = "image/" . basename($_FILES["photo"]["name"]);
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target)) {
            echo '';
        } else {
            echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . 'Problem in uploading image files.' . '<p/>';
        }
    }
    if (isset($_POST['submit'])) {
        $age = $_POST['age'];
        $surname = $_POST['surname'];
        $name = $_POST['user'];
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email format';
            exit;
        }
        if ($age < 18) {
            echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . '18+' . '<p/>';
            exit;
        }

        $to = $email = $_POST['email'];
        $subject = "Office supplies - Reminder";
        $message = "test\n\nyes";
        $headers = "From: belousalek2@gmail.com";


        if (mail($to, $subject, $message, $headers)) {
            $query = "INSERT INTO users (name,surname,email,age,photo) VALUES ('" . $name . "','" . $surname . "','" . $email . "','" . $age . "','" . $target . "')";
            mysqli_query($db, $query) or die ('Error in updating Database');

            ?>
            <script type="text/javascript">
                alert("Success full Added.");
                window.location = "index.php";
            </script>
            <?php
        } else{
            echo 'no';
        }
    }
}
?>