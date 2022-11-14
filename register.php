<?php
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
    Classes\Validation::validationPhoto($photo);
    $target = "image/" . basename($photo["name"]);
    if (move_uploaded_file($photo["tmp_name"], $target)) {
        echo '';
    } else {
        echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . 'Problem in uploading image files.' . '<p/>';
        exit;
    }

    if (isset($_POST['submit'])) {
        Classes\Validation::validationEmail($_POST['email']);
        Classes\Validation::validationAge($_POST['age']);
        Classes\Mail::sentMail($_POST['age'], $_POST['email'], $_POST['surname'], $_POST['user'], $target);
        Classes\Databases::insert($_POST['user'], $_POST['surname'], $_POST['email'], $_POST['age'],$target);

        ?>
        <script type="text/javascript">
            alert("Success full Added.");
            window.location = "index.php";
        </script>
        <?php
    }
}
?>