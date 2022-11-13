<?php
include 'connection.php';
spl_autoload_register();
?>
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
    Classes\Photo::validationPhoto($photo);
    $target = "image/" . basename($photo["name"]);
    if (move_uploaded_file($photo["tmp_name"], $target)) {
        echo '';
    } else {
        echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . 'Problem in uploading image files.' . '<p/>';
        exit;
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
        Classes\Mail::sentMail($age, $email, $surname, $name);
        $query = "INSERT INTO users (name,surname,email,age,photo) VALUES ('" . $name . "','" . $surname . "','" . $email . "','" . $age . "','" . $target . "')";
        mysqli_query($db, $query) or die ('Error in updating Database');

        ?>
        <script type="text/javascript">
            alert("Success full Added.");
            window.location = "index.php";
        </script>
        <?php
    }
}
?>