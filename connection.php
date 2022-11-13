<?php
 $db = mysqli_connect('localhost', 'root', '1234@Abcd') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'user3' ) or die(mysqli_error($db));
?>