<!DOCTYPE html>
<html >
<head>
    <title>Register</title>
</head>
<body>
<?php
include "../includes/nav.html";
?>
<div class="container">
	<div class="row">
		<div class="span3">
		</div>
		<div class="span6">
        <h1>Reset Your Password</h1>
			<form action="../Backend/password.php" method="post" class="form-signin" role="form">
				<input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Email address" />
				<input type="password" name="pass" size="10" maxlength="20" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>" placeholder="Current Password" />
				<input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" placeholder="New Password" />
				<input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" placeholder="Confirm New Password"  />
				<p><button class="btn btn-primary" name="submit" type="submit">Reset Password</button></p>
			</form>
		</div>
		<div class="span3">
		</div>
	</div>
</div>
