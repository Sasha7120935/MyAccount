<?php
spl_autoload_register();
session_start();
$id = $_SESSION['id'];
Classes\Databases::row($id);
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
            <img class="rounded-circle mt-5" src="<?php echo Classes\Databases::row($id)['photo'] ?>" width="90">
            <span class="font-weight-bold">Name:<?php echo Classes\Databases::row($id)['name']; ?></span>
            <span class="font-weight-bold">Surname:<?php echo Classes\Databases::row($id)['surname']; ?></span>
            <span class="font-weight-bold">Email:<?php echo Classes\Databases::row($id)['email']; ?></span>
            <span class="font-weight-bold">Age:<?php echo Classes\Databases::row($id)['age']; ?></span>
        </div>
        <div class="profile-input-field">
            <form method="post" action="#" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Photo</label>
                    <input type="file" class="form-control" name="photo" style="width:20em;"
                           value="<?php echo Classes\Databases::row($id)['photo']; ?>"/>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="user" style="width:20em;"
                           placeholder="Enter your Name"
                           value="<?php echo Classes\Databases::row($id)['name']; ?>" required/>
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input type="text" class="form-control" name="surname" style="width:20em;"
                           placeholder="Enter your Surname"
                           required value="<?php echo Classes\Databases::row($id)['surname']; ?>"/>
                </div>
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" class="form-control" name="age" style="width:20em;"
                           placeholder="Enter your Age"
                           value="<?php echo Classes\Databases::row($id)['age']; ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" style="width:20em;"
                           placeholder="Enter your Email"
                           value="<?php echo Classes\Databases::row($id)['email']; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" name="pdf" class="btn btn-primary" value="Export as PDF"
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
        Classes\Validation::validationPhoto($photo);
        $target = "image/" . basename($_FILES["photo"]["name"]);
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target)) {
            echo '';
        } else {
            echo '<p style="text-align: center; color: red; font-size: large; font-weight: bold;">' . 'Problem in uploading image files.' . '<p/>';
        }
        Classes\Validation::validationEmail($_POST['email']);
        Classes\Validation::validationAge($_POST['age']);
        Classes\Mail::sentMail($_POST['age'], $_POST['email'], $_POST['surname'], $_POST['user'], $target);
        Classes\Databases::update($_POST['user'], $_POST['surname'], $_POST['age'], $_POST['email'], $target, $id);
        ?>
        <script type="text/javascript">
            window.location = "profile.php";
        </script>
        <?php
    }
}
if (isset($_POST['pdf'])) {
    if (isset($_FILES['photo'])) {
        $age = $_POST['age'];
        $email = $_POST['email'];
        $surname = $_POST['surname'];
        $name = $_POST['user'];
        $target = basename($_FILES["photo"]["name"]);
        Classes\Pdf::getPdf($_POST['age'], $_POST['email'], $_POST['surname'], $_POST['user'], $target);
    }
}