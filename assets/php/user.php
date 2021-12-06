<?php
require 'db.php';
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$hostaddr  = $_SERVER['HTTP_HOST'];
// Processing form data when form is submitted
if(isset($_POST['signupform'])){ //POST FOR SIGNUP
    // Validate username
	
    if(empty(trim($_POST["signupemail"]))){
        $err = "Please enter an email.";
        header("Location: http://$hostaddr/login.php?error=true&detail=$err");
        die();
    } else{
        // Prepare a select statement
        $sql = "SELECT email FROM user WHERE email = ?";
        
        if($stmt = mysqli_prepare($connection_db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["signupemail"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $err = "This email is already taken.";
            header("Location: http://$hostaddr/login.php?error=true&detail=$err");
                    die();
                } else{
                    $username = trim($_POST["signupemail"]);
                }
            } else{
                $err = "Oops! Something went wrong. Please try again later.";
            header("Location: http://$hostaddr/login.php?error=true&detail=$err");
                die();
            }
        }
             // Close statement
        mysqli_stmt_close($stmt);   
    }

    if(empty(trim($_POST["signupusername"]))){
        $err = "Please enter an email.";
        header("Location: http://$hostaddr/login.php?error=true&detail=$err");
        die();
    } else{
        // Prepare a select statement
        $sql = "SELECT username FROM user WHERE username = ?";
        
        if($stmt = mysqli_prepare($connection_db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_user);
            
            // Set parameters
            $param_user = trim($_POST["signupusername"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $err = "This username is already taken.";
                    header("Location: http://$hostaddr/login.php?error=true&detail=$err");
                    die();
                } else{
                    $user = trim($_POST["signupusername"]);
                }
            } else{
                $err = "Oops! Something went wrong. Please try again later.";
                header("Location: http://$hostaddr/login.php?error=true&detail=$err");
                die();
            }
        }
             // Close statement
        mysqli_stmt_close($stmt);   
    }
    
    // Validate password
    if(empty(trim($_POST["signuppassword"]))){
        $err = "Please enter a password.";   
        header("Location: http://$hostaddr/login.php?error=true&detail=$err");
        die();  
    } elseif(strlen(trim($_POST["signuppassword"])) < 8){
        $err = "Password must have atleast 8 characters.";
        header("Location: http://$hostaddr/login.php?error=true&detail=$err");
        die();
    } else{
        $password = trim($_POST["signuppassword"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirmpassword"]))){
        $err = "Please confirm password."; 
        header("Location: http://$hostaddr/login.php?error=true&detail=$err");
            die();
    } else{
        $confirm_password = trim($_POST["confirmpassword"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $err = "Password did not match.";
            header("Location: http://$hostaddr/login.php?error=true&detail=$err");
            die();
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user (email, password, username) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($connection_db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 'sss', $param_username, $param_password, $param_user);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_user = $user;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                $host  = $_SERVER['HTTP_HOST'];
                header("Location: http://$host/login.php");
            } else{
                $err = "Something went wrong. Please try again later.";
                header("Location: http://$hostaddr/login.php?error=true&detail=$err");
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($connection_db);
}


if(isset($_POST['loginform'])) {
session_start();
$host  = $_SERVER['HTTP_HOST'];
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("Location: http://$host/index.php");
    exit;
} 
    // Define variables and initialize with empty values
    $username = $password = "";
    $username_err = $password_err = "";
 
    // Processing form data when form is submitted

 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "email is Empty.";
            header("Location: http://$host/login.php?lgerror=$username_err");
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
        header("Location: http://$host/login.php?lgerror=$password_err");
        die();
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT email, password, id FROM user WHERE email = ?";
        
        if($stmt = mysqli_prepare($connection_db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password, $userid);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;  
                            $_SESSION["userid"] = $userid;
                            header("Location: http://$host/index.php");                          
                            // Redirect user to welcome page
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password is not valid.";
                        header("Location: http://$host/login.php?lgerror=$password_err");
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that email.";
                    header("Location: http://$host/login.php?lgerror=$username_err");
                    die();
                }
            } else{
                $err = "Oops! Something went wrong. Please try again later.";
                header("Location: http://$host/login.php?lgerror=$err");

            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($connection_db);
}

if (isset($_GET['logout'])) {
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
$host  = $_SERVER['HTTP_HOST'];
header("location: http://$host/login.php");
exit;
}
?>