<?php
include 'connection.php';
spl_autoload_register();
session_start();
$id = $_SESSION['id'];
$query = mysqli_query($db, "SELECT * FROM users where user_id='$id'") or die(mysqli_error());
$row = mysqli_fetch_array($query);
?>
    <!DOCTYPE html>
    <html lang="en-US">
    <head>
        <title>Project</title>
        <link rel="stylesheet" href="libs/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="libs/css/bootstrap.min.css">
        <link rel="stylesheet" href="libs/style.css">
    </head>
    <div class="container-profile">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <img class="rounded-circle mt-5" src="<?php echo $row['photo'] ?>" width="90">
            <span class="font-weight-bold">Name:<?php echo $row['name']; ?></span>
            <span class="font-weight-bold">Surname:<?php echo $row['surname']; ?></span>
            <span class="font-weight-bold">Email:<?php echo $row['email']; ?></span>
            <span class="font-weight-bold">Age:<?php echo $row['age']; ?></span>
        </div>
        <div class="profile-input-field">
            <form method="post" action="#" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Photo</label>
                    <input type="file" class="form-control" name="photo" style="width:20em;"
                           value="<?php echo $row['photo']; ?>"/>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="user" style="width:20em;"
                           placeholder="Enter your Name"
                           value="<?php echo $row['name']; ?>" required/>
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input type="text" class="form-control" name="surname" style="width:20em;"
                           placeholder="Enter your Surname"
                           required value="<?php echo $row['surname']; ?>"/>
                </div>
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" class="form-control" name="age" style="width:20em;"
                           placeholder="Enter your Age"
                           value="<?php echo $row['age']; ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" style="width:20em;"
                           placeholder="Enter your Email"
                           value="<?php echo $row['email']; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" name="pdf" class="btn btn-primary" value="PDF"
                           style="width:20em; margin:0;">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Update"
                           style="width:20em; margin:0;"><br><br>
                    <center>
                        <a href="logout.php">Log out</a>
                    </center>
                </div>
            </form>
        </div>
    </div>
    </html>
<?php
if (isset($_POST['submit'])) {
    if (isset($_FILES['photo'])) {
        $photo = $_FILES['photo'];
        Classes\Photo::validationPhoto($photo);
        $target = "image/" . basename($_FILES["photo"]["name"]);
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target)) {
            echo '';
        } else {
            echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . 'Problem in uploading image files.' . '<p/>';
        }
        $age = $_POST['age'];
        $surname = $_POST['surname'];
        $name = $_POST['user'];
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email format';
        }
        $query = "UPDATE users SET name = '$name', surname = '$surname', age = '$age', email = '$email', photo ='$target' WHERE user_id = '$id'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        ?>
        <script type="text/javascript">
            window.location = "profile.php";
        </script>
        <?php
    }
}