<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="assets/js/1351.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src = "assets/js/buttonevents.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
</head>
<body id = "lg-body">
    <?php
    session_start();
    $hostaddr  = $_SERVER['HTTP_HOST'];
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("Location: http://$hostaddr/index.php");
    echo $_SESSION["loggedin"];
}
?>

    <div id="main-lg-container">
        <div class="lg-form-container" >
            <img src="/assets/images/proto.png" class="img-fluid" alt="" id="login-logo">

            <form class="login-form" id = "loginform" method = "POST" action = "assets/php/user.php">
                <div class="lg-form-cover form-group">    
                    <h4 class = "text-center lg-title">Login</h4>  
                    <div class = "lg-err-div" style = "color: red;"><?php  if (isset($_GET['lgerror'])) {echo $_GET['lgerror'];} ?></div>        

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type = "button"><i class="fal fa-envelope lg-icon"></i></button disabled>
                        </div>
                            <input type="text" name="username" id="email" class="form-control form-control-lg lg-input" placeholder = "Email address" required >
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type = "button"><i class="fal fa-lock-alt lg-icon"></i></button disabled>
                        </div>
                            <input name="password" placeholder = "Password" id="password" type = "password" class="form-control-lg form-control" required>
                    </div>
                    <input type = "hidden" name = "loginform">
                    <button class="action_btn login-btn" type = "submit" >Login</button>
                </div>
                <p class = "text-center lg-f-signup" onclick = "logincontroller('loginform','signupform')" id = "lg-contrl"><a href = "#">New User? Sign up here</a></p>
            </form>
            <form class="login-form" id = "signupform" method = "POST" action = "assets/php/user.php">
                <div class="lg-form-cover form-group">  
                    <h4 class = "text-center lg-title">Signup</h4>
                    <div class = "lg-err-div"><?php  if (isset($_GET['detail'])) {echo $_GET['detail'];} ?></div>       
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type = "button"><i class="fal fa-user"></i></button>
                        </div>
                            <input type="text" name="signupusername" id="signupemail" class="form-control form-control-lg lg-input" placeholder = "Username" required >
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type = "button"><i class="fal fa-envelope lg-icon"></i></button>
                        </div>
                            <input type="text" name="signupemail" id="signupemail" class="form-control form-control-lg lg-input" placeholder = "Email address" required >
                    </div>


                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type = "button"><i class="fal fa-lock-alt lg-icon"></i></button disabled>
                        </div>
                            <input name="signuppassword" placeholder = "Password" id="signuppassword" type = "password" class="form-control-lg form-control" required>                                    
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type = "button"><i class="fal fa-lock-alt lg-icon"></i></button disabled>
                        </div>
                            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control form-control-lg lg-input" placeholder = "Confirm password" required >
                    </div>
                    <input type = "hidden" name = "signupform">
                    <button class="action_btn login-btn" type = "submit" >Signup</button>

                    <p class = "text-center lg-f-signup" onclick = "logincontroller('signupform','loginform')"><a href = "#">Already have an account? Login here</a></p>

                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>
<script>
    var errorExist = '<?php echo $_GET['error'] ?>';
    var errorDetail = '<?php echo $_GET['error'] ?>';

    if (!errorExist.empty) {
        document.getElementById('loginform').style.display = "none"; 
        document.getElementById('signupform').style.display = "block";    
    }
</script>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"
integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd"
crossorigin="anonymous"></script>
</html>