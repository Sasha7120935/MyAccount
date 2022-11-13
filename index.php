<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Project</title>
    <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/style.css">
</head>
<div class="input-field">
    <h3>Login</h3>
    <form method="post" action="#">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="image/download.png" width="90"></div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="user" style="width:20em;" placeholder="Enter your Name"
                   required/>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" id="email" style="width:20em;" placeholder="Enter your Email"
                   name="email" required/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit"  value="Sign In" class="btn btn-primary submitBtn" style="width:20em; margin:0;"/><br><br>
            <center>
                <a href="register.php">Create Account</a>
            </center>
        </div>

    </form>
</div>
</html>
<?php
session_start();
include 'connection.php';
if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $email = $_POST['email'];
    $query = mysqli_query($db, "SELECT * FROM users WHERE name = '$user' AND email = '$email'");
    $num_rows = mysqli_num_rows($query);
    $row = mysqli_fetch_array($query);
    $_SESSION["id"] = $row['user_id'];
    if ($num_rows > 0) {
        ?>
        <script>
            alert('Successfully Log In');
            document.location = 'profile.php'
        </script>
        <?php
    } else {
        echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . 'Not recorded with such data' . '<p/>';
    }
}
?>