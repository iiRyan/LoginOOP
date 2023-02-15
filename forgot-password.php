<?php
require "classes/dbconn.php";
require('classes/login-class.php');


$reset = new Login();
if (isset($_POST['submit'])) {
	$result = $reset->passwordReset($_POST['email']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="includes/style.css" />

	<title>Password reset</title>
</head>

<body>
	<form class="form" action="" method="post">
		<h2>Password reset</h2>
		<h4>Please enter your email so we can send you a new password.</h4>
		<div>
			<label>Email</label>
			<input type="text" class="login-input" name="email" value="<?php echo @$_POST['email']; ?>">
		</div>

		<button type="submit" class="login-button" name="submit">Submit</button>

		<p>
			<a href="login.php">Back to login page?</a>
		</p>

		<?php
		if (@$result == "success") {
		?>
			<p class="success">Please go to your email account and use your new password.</p>
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