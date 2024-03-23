<!DOCTYPE html>
<html>
	<head>
		<title>Contact Us</title>
	</head>
	<body>
	<?php
include "../includes/nav.html";
?>
<h3>Contact Raters Uk</h3>
<div style="width:60%"class ="form">	
<h4>Please fill out this form to contact Raters Uk.</h4>
    <form action="../Backend/contact.php" method="post" >
      <div class="form-group">
		<label for="name">Name:</label>
         <input id= "name" class="form-control" type="text" name="name" size="30" maxlength="60" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
      </div>
	  <div class="form-group">
		<label for="email">Email Address:</label>
         <input id= "name" class="form-control" type="text" name="email" size="30" maxlength="80" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" >
      </div>
	  <div class="form-group">
		<label for="comments">Enquiry:</label>
		<textarea name="comments" class="form-control" rows="5" cols="30"><?php if (isset($_POST['comments'])) echo $_POST['comments']; ?></textarea>
      </div>
      <br/>
      <button type="submit" class = "submit" value="Submit">Submit</button>
    </form>
    </div>
    </div>
</body>
</html>


