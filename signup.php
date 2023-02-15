<?php


require_once('classes/dbconn.php');

require_once('classes/signup-class.php');

if (isset($_SESSION['id'])) {
    header("Location:index.php");
}

$signup = new Register();

if (isset($_POST["submit"])) {
    $result = $signup->registeration($_POST["name"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["confirmpassword"]);
}

?>

<!DOCTYPE html>

<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="includes/style.css" />

</head>

<body>
    <div class="img">
        <img src="includes/yeswa.svg" alt="YESWA" height="200" width="200" />
    </div>
    <form class="form" action="" method="post">

        <input type="text" class="login-input" name="name" placeholder="Name" value="<?php echo @$_POST['name']; ?>">
        <br>
        <input type="text" class="login-input" name="username" placeholder="Username" value="<?php echo @$_POST['username']; ?>"> <br>
        <input type="text" class="login-input" name="email" placeholder="Email" value="<?php echo @$_POST['email']; ?>">
        <br>
        <input type="password" class="login-input" name="password" placeholder="Password" value="<?php echo @$_POST['password']; ?>"> <br>
        <input type="password" class="login-input" name="confirmpassword" placeholder="Confirm Password" value="<?php echo @$_POST['confirmpassword']; ?>"> <br>

        <button type=" submit" class="login-button" name="submit" value="">Signup</button>
        <p class="link"><a href="login.php">Login From here</a></p>

        <?php
        if (@$result == "success") {
        ?>
            <p class="success">Your registration was successful</p>
        <?php
        } else {
        ?>
            <p class="error"><?php echo @$result; ?></p>
        <?php
        }
        ?>


    </form>

</body>

</html>