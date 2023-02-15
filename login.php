<?php

require_once('classes/dbconn.php');
require('classes/login-class.php');


$login = new Login();

if (isset($_POST["submit"])) {
    $result = $login->login($_POST["username"], $_POST["password"]);
}
?>
<!DOCTYPE html>

<head>
    <title>Log In</title>
    <link rel="stylesheet" href="includes/style.css" />
</head>

<body>
    <div class="img">
        <img src="includes/yeswa.svg" alt="YESWA" height="300" width="300" />
    </div>
    <form class="form" action="" method="post">
        <input class="login-input" type="text" autofocus="true" name="username" placeholder="username" value="<?php echo @$_POST['username']; ?>"><br>
        <input class="login-input" type="password" name="password" placeholder="Password" value="<?php echo @$_POST['password']; ?>"><br>
        <button class="login-button" type="submit" name="submit">Login</button>
        <p class="link"><a href="signup.php">New Registration</a></p>
        <p class="error"><?php echo @$result; ?></p>
        <p>
            <a href="forgot-password.php">Forgot password?</a>
        </p>

    </form>
</body>

</html>