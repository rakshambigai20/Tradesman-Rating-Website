<?php
if (session_id() == '') {
    session_start();
}

class Account{
private $email;
private $password;
private $newPassword1;
private $newPassword2;

public function __construct($email,$password)
{
    $this->email=$email;
    $this->password=$password;
}

public function login() {
    if (!empty($_POST['email']) && !empty($_POST['pass']) ){
    require('dbh.inc.php');
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $q = "SELECT * FROM users WHERE EMAIL='$email' AND PWD=SHA1('$password');";  
    $r = mysqli_query($dbc, $q);
    if (mysqli_num_rows($r) == 1) {
        // User found, fetch user details
        $row = mysqli_fetch_assoc($r);
        $hashed_password = $row['PWD'];
        $user_role = $row['role']; // assuming 'role' is the column name

        // Password matches, create a session
        if (sha1($password) == $hashed_password) {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;


            // Check user role and redirect accordingly
            if ($user_role == 'admin') {

                 echo "<script>
            alert('Welcome, " . $_SESSION['email'] . "! You are logged in.');
            window.location.href='../Frontend/adminHomePage.php';
          </script>";
                exit();
            } 
            else {
                echo "<script>alert('Welcome, " . $_SESSION['email'] . "! You are logged in.');
                window.location.href='../Frontend/tradesmanHomepage.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Invalid Credentials');</script>";
            include('../Frontend/loginForm.php');
        }
    } 
    else {
        // User not found
        echo "<script>alert('Invalid Credentials');</script>";
        include('../Frontend/loginForm.php');
    }
    mysqli_close($dbc);
}
}
public static function logout() {
    if (isset($_SESSION['email'])) {
        // Clear all session data and destroy the session
        $_SESSION = array();
        session_destroy();

        // Redirect to the login page
        header("Location: ../Frontend/loginForm.php");
        exit();
    }
}
public static function resetPassword($email, $currentPassword, $newPassword1, $newPassword2) {
    require ('dbh.inc.php');
    $errors = array();

    if (empty($email)) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $e = $dbc->real_escape_string(trim($email));
    }

    if (empty($currentPassword)) {
        $errors[] = 'You forgot to enter your current password.';
    } else {
        $p = $dbc->real_escape_string(trim($currentPassword));
    }

    if (empty($newPassword1) || empty($newPassword2)) {
        $errors[] = 'You forgot to enter your new password.';
    } elseif ($newPassword1 != $newPassword2) {
        $errors[] = 'Your new password did not match the confirmed password.';
    } else {
        $np = $dbc->real_escape_string(trim($newPassword1));
    }

    if (empty($errors)) {
        $q = "SELECT * FROM users WHERE EMAIL='$email' AND PWD=SHA1('$currentPassword')";
        $r = $dbc->query($q);

        if ($r->num_rows == 1) {
            $q = "UPDATE users SET PWD=SHA1('$newPassword1') WHERE EMAIL='$email'";
            $r = $dbc->query($q);

            if ($dbc->affected_rows == 1) {
                echo '<h1>Thank you!</h1><p>Your password has been updated. You can now <a href="../Frontend/loginForm.php">login</a></p>';
            } else {
                echo '<h1>System Error</h1><p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';
            }
        } else {
            echo '<h1>Error!</h1><p class="error">The email address and password do not match those on file.</p>';
        }
    } else {
        echo '<h1>Error!</h1><p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) {  
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p>';
    }

    $dbc->close();
}

    }
    

class admin extends Account{
public function addSkills()
{ 

    
        if (!empty($_POST['type'])) {
            require('dbh.inc.php');
            $skill = $_POST['type'];
            $e = "INSERT INTO skill (type) VALUES ('$skill')";
            $result = $dbc->query($e);

            if ($result === true) {
                echo "<script>
            alert('Skill added successfully');
          </script>";
          header("Location: ../Frontend/skillsPage.php");
            } else {
                echo "Error adding skill";
            }
            $dbc->close();
        }
        
        
    }
    public function deleteSkills()
    { 
    if (!empty($_POST['ID'])) {
            require('dbh.inc.php');
            $skillId = $_POST['ID'];
            $e = "DELETE FROM skill WHERE ID = '$skillId';";
            $result = $dbc->query($e);

            if ($result === true) {
                echo "<script>
            alert('Skill deleted successfully');
          </script>";
          header("Location: ../Frontend/skillsPage.php");
            } else {
                echo "Error deleting skill";
            }
            $dbc->close();
        
    }

}
public function deleteProfile()
    { 
        
            if (!empty($_POST['email'])) {
                require('dbh.inc.php');
                $tradesmanEmail = $_POST['email'];
                $e = "DELETE FROM users WHERE EMAIL = '$tradesmanEmail';";
                $result = $dbc->query($e);
    
                if ($result === true) {
                    echo "<script>
                alert('Profile deleted successfully');
              </script>";
              header("Location: ../Frontend/viewTradesmanProfile.php");
                } else {
                    echo "Error deleting profile";
                }
                $dbc->close();
            }

}

}
class Tradesman extends Account
{
private $mobileNum;
private $professionalRecognition;
private $skill;
private $availability;
private $hourlyPay;
private $location;
private $experience;
private $references;

public function register() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require ('dbh.inc.php');
        $email = $_POST["email"] ?? '';
        $confirm_email = $_POST["confirm_email"] ?? '';
        $create_password = $_POST["create_password"] ?? '';
        $re_password = $_POST["re_password"] ?? '';
        $errors = array();
    
        if (empty($email) || empty($confirm_email)) {
            $errors[] = 'Enter your email.';
        } elseif ($email != $confirm_email) { 
            $errors[] = 'Emails do not match.';
        }
    
        if (empty($create_password)) {
            $errors[] = 'Enter your password.';
        } elseif ($create_password != $re_password) {
            $errors[] = 'Passwords do not match.';
        }
    
        if (empty($errors)) {
            $email = $dbc->real_escape_string(trim($email));
            $create_password = $dbc->real_escape_string(trim($create_password));
    
            // Check if email already exists
            $q = "SELECT * FROM users WHERE EMAIL='$email'";
            $r = $dbc->query($q);
            if ($r->num_rows != 0) {
                echo "<script>
                alert('Email Address is already registered');
                window.location.href = '../Frontend/registerForm.php';
                </script>";
                exit(); // Ensure no further PHP code is executed
            }
            else
            {
                // Generate a unique random code
            do {
                    $randomCode =$this->generateRandomCode();
                } while (!$this->isCodeUnique($randomCode, $dbc));
    
                // Insert the new user with the unique random code
                $q = "INSERT INTO users (EMAIL, PWD, rating_code) VALUES ('$email', sha1('$create_password'), '$randomCode');";
                $r = $dbc->query($q);
                if ($r) { 
                    echo "<script>
                    alert('Registered with unique code: $randomCode');
                    window.location.href = '../Frontend/loginForm.php';
                    </script>";
                    
                    
                } else {
                    echo "<script>alert('Error during registration.');</script>";
                }
            }
        } else {
            // Display errors
            echo '<h1>Error!</h1><p id="err_msg">The following error(s) occurred:<br>';
            foreach ($errors as $msg) {
                echo " - $msg<br>";
            }
            echo 'Please try again.</p>';
        }
        $dbc->close();
    }
}
    private  function generateRandomCode($minLength = 4, $maxLength = 4) {
        $length = rand($minLength, $maxLength);
        $randomCode = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= rand(0, 9);
        }
        return $randomCode;
    }
    private function isCodeUnique($code, $dbc) {
        $query = "SELECT * FROM users WHERE rating_code = '$code'";
        $result = $dbc->query($query);
        return $result->num_rows == 0; // True if unique, False otherwise
    }
    public function viewPersonal() {
        if (isset($_SESSION['email'])) {
            require ('dbh.inc.php');
            $loggedInEmail = $_SESSION['email'];
            $query = "SELECT * FROM users WHERE EMAIL = ?";
            if ($stmt = $dbc->prepare($query)) {
                $stmt->bind_param("s", $loggedInEmail);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $userData = $result->fetch_assoc();
                    return $userData; // Return user data to be displayed
                } else {
                    echo "<script>alert('User not found');</script>";
                }
                $stmt->close();
            }
            $dbc->close();
        }
    }
    public function viewProfessional() {
        if (isset($_SESSION['email'])) {
            require ('dbh.inc.php');
            $loggedInEmail = $_SESSION['email'];
            $query = "SELECT * FROM users WHERE EMAIL = ?";
            if ($stmt = $dbc->prepare($query)) {
                $stmt->bind_param("s", $loggedInEmail);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $userData = $result->fetch_assoc();
                    return $userData; // Return user data to be displayed
                } else {
                    echo "<script>alert('User not found');</script>";
                }
                $stmt->close();
            }
            $dbc->close();
        }
    }
    public function updatePersonal($email, $name, $selectedLocation, $postalCode, $phone_number) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $name = $_POST["name"];
            $email = $_POST["email"];
            $postalCode = $_POST["postalCode"];
            $phone_number = $_POST["number"];
            $selectedLocation = $_POST["location"];
        
            require ('dbh.inc.php');
        
            $e = "SELECT EMAIL from users where EMAIL='$email';";
            $result = $dbc->query($e);
            if ($result->num_rows == 0) {
                echo "Enter registered email ID";
            } elseif ($result->num_rows > 0) {
                $q = "UPDATE users 
                      SET name='$name',
                      location='$selectedLocation',
                      postal_code= '$postalCode',
                      phone='$phone_number'
                      WHERE EMAIL='$email';";
                $r = $dbc->query($q);
                if ($r) { 
                    echo "<script>alert('Personal information updated successfully');
                    window.location.href = '../Frontend/personalDetailsPage.php';
                    </script>";
                    
                }
            }
        
            exit();
        }
    }
    
    public function updateProfessionalDetails($email, $start, $end, $pay, $exp, $skill, $pg_status, $pgFilePath) {
        // Assuming a database connection is established in the Account class
        require ('dbh.inc.php'); // Retrieve the database connection

        // Sanitize input to prevent SQL injection
        $email = $dbc->real_escape_string($email);
        $start = $dbc->real_escape_string($start);
        $end = $dbc->real_escape_string($end);
        $pay = $dbc->real_escape_string($pay);
        $exp = $dbc->real_escape_string($exp);
        $skill = $dbc->real_escape_string($skill);
        $pg_status = $dbc->real_escape_string($pg_status);
        $pgFilePath = $dbc->real_escape_string($pgFilePath);

        // Prepare SQL query
        $stmt = $dbc->prepare("UPDATE users SET start_time = ?, end_time = ?, hourly_pay = ?, work_exp = ?, skills = ?, pg_status = ?, pg_content = ? WHERE EMAIL = ?");
        $stmt->bind_param("ssssssss", $start, $end, $pay, $exp, $skill, $pg_status, $pgFilePath, $email);

        // Execute the query
        if ($stmt->execute()) {
            echo "Professional details updated successfully.";
        } else {
            echo "Error updating professional details: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $dbc->close();
    }

    public function viewAllPersonalDetails($email) {
        require ('dbh.inc.php');

        // Retrieve personal details for the given email
        $e = "SELECT * FROM users WHERE EMAIL='$email';";
        $result = $dbc->query($e);

        if ($result->num_rows == 1) {
            $userData = $result->fetch_assoc();
            return $userData;
        } else {
            return false; // User not found
        }
    }

   

}

?>