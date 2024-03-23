<!DOCTYPE html>
<html >
<head>
    <title>Register</title>  
</head>
<body>
<?php
include "../includes/nav.html";
?>
       
    <div class ="form">	
    <h2>Register</h2>
    <form action="../Backend/register.php" method="POST">
      <div class="form-group">
         <input id= "email" type="email" class="form-control" name= "email" placeholder="Enter your email address">
      </div>
      <div class="form-group">
         <input id= "confirm_email" type="email" class="form-control" name= "confirm_email" placeholder="Re-enter your email address">
      </div>
      <div class="form-group">
         <input id= "create_password" type="password" class="form-control" name= "create_password" placeholder="Password">
      </div>
      <div class="form-group">
         <input id= "re_password" type="password" class="form-control" name= "re_password" placeholder="Re-enter password ">
      </div>
      <br/>
      <button type="submit" class = "submit">Register</button>
      
    </form>
    </div>
    </div>
</body>
</html>
