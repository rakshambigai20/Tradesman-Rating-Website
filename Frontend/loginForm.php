<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    
</head>
<body>
    <?php
include "../includes/nav.html";
?>
<div class ="form">	
<h2>Login to Your Account</h2>
    <form action="../Backend/login.php" method="post">
      <div class="form-group">
         <input id= "email" class="form-control" type="email" name="email" placeholder="Email" required>
      </div>
      <div class="form-group">
         <input id= "create_password" class="form-control" type="password" name="pass" placeholder="Password" required>
      </div>
      <br/>
      <button type="submit" class = "submit" value="Login">Login</button>
      <span class="psw"><a href="resetPasswordPage.php">Reset Password</a></span>
    </form>
    </div>
    </div>

</body>
</html>


