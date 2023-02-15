<?php
require 'classes/dbconn.php';
require('classes/login-class.php');

$logout = new Login();
if (!isset($_SESSION['user'])) {
    header("location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    $logout->logoutUser();
}


if (isset($_GET['confirm-account-deletion'])) {
    $logout->deleteAccount();
}

?>
<!DOCTYPE html>

<head>

    <title>HOME</title>
    <link rel="stylesheet" href="includes/style.css" />

</head>

<body>
    <h2>Welcome <?php echo $_SESSION["user"] ?> </h2>
    <a href="?logout">Logout</a>

    <?php
    if (isset($_GET['delete-account'])) {
    ?>
        <p class="confirm-deletion">
            Are you sure you want to delete you account?
            <a class="confirm-deletion" href="?confirm-account-deletion">Delete account</a>
        </p>
    <?php
    } else {
    ?>
        <a href="?delete-account">Delete account</a>
    <?php
    }
    ?>
</body>

</html>