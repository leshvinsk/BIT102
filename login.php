<?php
session_start();

if(isset($_SESSION["user"]))  
{  
    // Assuming $_SESSION["user"] contains the role information ('Customer' or 'Staff')
    $role = $_SESSION["user"]["role"];

    // Redirect based on the role
    if ($role == 'Customer') {
        header("location: customer/index.php");
    } elseif ($role == 'Staff') {
        header("location: staff/inventory.php");
    } 
    exit; // Make sure to stop script execution after redirection
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Salad Atelier</title>
    <link rel="icon" href="images/title_logo.png" type="image/icon type">
    <link rel="stylesheet" href="assets/assets_customer/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
<video autoplay loop muted plays-inline class="back-video">
    <source src="assets/assets_customer/img/background-video.mp4" type="video/mp4">
</video>
<main>
    <div class="box">
        <div class="inner-box">
            <div class="forms-wrap">
                <form autocomplete="off" id="login" method="POST" action="login.php" class="sign-in-form">
                    <div class="logo"></div>
                    <div class="heading">
                        <h2>Welcome Back</h2>
                        <h6>Not Registered Yet?</h6>
                        <a class="toggle">Register Here</a>
                    </div>
                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="text" class="input-field" name="username" required />
                            <label>Username</label>
                        </div>
                        <div class="input-wrap">
                            <input type="password" class="input-field" name="password" id="password" required />
                            <label>Password</label>
                        </div>
                        <input type="submit" name="login_submit" value="Log In" class="sign-btn"/>
                        <p class="text">
                            Forgot Your Login Details?
                            <a class="data">Get Help Here</a>
                        </p>
                    </div>
                    <button type="button" name="Main Menu" onclick="window.location.href = 'http://localhost/Test/index.php';" class="sign-btn-main"> Main Menu</button>
                </form>

                <form autocomplete="off" id="register" method="POST" action="login.php" class="sign-up-form">
                    <div class="logo"></div>
                    <div class="heading">
                        <h2>Get Started</h2>
                        <h6>Already Have an Account?</h6>
                        <a class="toggle">Log In Here</a>
                    </div>
                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="text" name="customer_name" class="input-field" required/>
                            <label>Full Name</label>
                        </div>
                        <div class="input-wrap">
                            <input type="text" name="username" class="input-field" required/>
                            <label>Username</label>
                        </div>
                        <div class="input-wrap">
                            <input type="email" name="email" class="input-field" required />
                            <label>Email</label>
                        </div>
                        <div class="input-wrap">
                            <input type="password" name="password" class="input-field" minlength="8" id="password_register" required/>
                            <label>Password</label>
                        </div>
                        <input type="submit" name="register_submit" value="Register" class="sign-btn" />
                        <p class="text">
                            I agree to the Terms and Conditions
                        </p>
                    </div>
                    <button type="button" name="Main Menu" onclick="window.location.href = 'http://localhost/Test/index.php';" class="sign-btn-main"> Main Menu</button>
                </form>

                <form autocomplete="off" id="forgot" method="POST" action="login.php" class="forgot-password-form">
                    <div class="logo"></div>
                    <div class="heading">
                        <h2>Let's Sort It</h2>
                        <h6>Changed Your Mind?</h6>
                        <a href="login.php" class="toggle">Return Here</a>
                    </div>
                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="email" class="input-field" name="email" required/>
                            <label>Email</label>
                        </div>
                        <input type="submit" name="reset_submit" value="Reset Password" class="sign-btn" />
                        <p class="text">
                            By resetting, I agree to 
                            Terms of Services and
                            Privacy Policy
                        </p>
                    </div>
                    <button type="button" name="Main Menu" onclick="window.location.href = 'http://localhost/Test/index.php';" class="sign-btn-main"> Main Menu</button>
                </form>
            </div>
            <div class="carousel">
                <div class="images-wrapper">
                    <img src="assets/img/header_logo.png" class="image img-1 show" style="padding-top: 200px;padding-left: 25px;"/>
                </div>
                <div class="text-slider"></div>
            </div>
        </div>
    </div>
</main>
<script src="assets/assets_customer/app.js"></script>
</body>
</html>
<script>
$(document).ready(function() {
    $("video").bind("contextmenu",function(){
        return false;
    });
});
</script>
<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    
    if (isset($_POST["login_submit"])) {
        // Process login form
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
    
        // Hash the password using sha256 before comparing it to the database
        $hashed_password = hash('sha256', $password);
    
        // Query to fetch user details based on username and hashed password
        $sql = "SELECT UserID, Role FROM users WHERE Username = '$username' AND Password = '$hashed_password'";
        $result = mysqli_query($con, $sql);
    
        if (!$result) {
            die('Query failed: ' . mysqli_error($con));
        }
    
        // Check if there is exactly one matching user
        $count = mysqli_num_rows($result);
    
        if ($count == 1) {
            $row = mysqli_fetch_assoc($result);
            $role = $row['Role'];

            // Set session variable based on role and redirect accordingly
            if ($role == 'Customer') {
                $_SESSION['user'] = $username;
                echo '<script>window.location.href = "customer/index.php";</script>';
            } elseif ($role == 'Staff') {
                $_SESSION['user'] = $username;
                echo '<script>window.location.href = "staff/inventory.php";</script>';
            }
        } else {
            // Login failed, show error message
            echo '<script>alert("Username or Password is Invalid");</script>';
        }
    }elseif (isset($_POST["register_submit"])) {
        $customer_name = mysqli_real_escape_string($con, $_POST['customer_name']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $lcslength = strlen($password);
    
        // Validate password format using regex
        if ($lcslength < 8 || !preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $password)) {
            echo "<script type='text/javascript'>alert('Password must be more than 8 characters and contain at least one alphabet and one number')</script>";
        } else {
            // Hash the password before storing it in the database
            $hashed_password = hash('sha256', $password);
    
            // Generate a random 9-digit loyalty number starting with 0-8
            do {
                $first_digit = rand(0, 8);
                $loyalty_number = $first_digit . sprintf('%08d', rand(0, 99999999));
    
                // Check if the loyalty number already exists in the database
                $check_query = "SELECT * FROM `users` WHERE `LoyaltyNumber` = '$loyalty_number'";
                $result = mysqli_query($con, $check_query);
            } while (mysqli_num_rows($result) > 0);
    
            // Insert the new user with the generated loyalty number
            $sql = "INSERT INTO `users`(`FullName`, `Username`, `Password`, `Email`, `LoyaltyNumber`, `Role`, `AccountStatus`) VALUES ('$customer_name', '$username', '$hashed_password', '$email', '$loyalty_number', 'Customer', 'Unverified')";
            if (mysqli_query($con, $sql)) {
                echo "<script>alert('Customer has been Registered Successfully'); window.location.href = 'login.php';</script>";
            } else {
                echo '<script>alert("An unexpected error has occurred.")</script>';
            }
        }
    }elseif (isset($_POST["reset_submit"])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

        $sql = "UPDATE `users` SET reset_token_hash = '$token_hash', reset_token_expires_at = '$expiry' WHERE email = '$email'";
        if (isset($_POST["reset_submit"])) {
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $token = bin2hex(random_bytes(16));
            $token_hash = hash("sha256", $token);
            $expiry = date("Y-m-d H:i:s", time() + 60 * 30);
        
            $sql = "UPDATE `users` SET reset_token_hash = '$token_hash', reset_token_expires_at = '$expiry' WHERE email = '$email'";
            if (mysqli_query($con, $sql)) {
                if (mysqli_affected_rows($con)) {
                    $mail = require __DIR__ . "/mailer.php";
        
                    $mail->setFrom("noreply@example.com", "Salad Atelier");
                    $mail->addAddress($email);
                    $mail->Subject = "Password Reset";
                    $mail->Body = <<<END
                    Click <a href="http://localhost/Test/reset.php?token=$token">here</a>
                    to reset your password.
                    END;
        
                    try {
                        $mail->send();
                        echo '<script> alert("Reset Link has been sent. Please check your Inbox.");</script>';
                    } catch (Exception $e) {
                        echo '<script>alert("A mailer error has occurred: '.$mail->ErrorInfo.'")</script>';
                    }
                } else {
                    echo '<script>alert("Reset Link has been sent. Please check your Inbox.")</script>';
                }
            } else {
                echo '<script>alert("An unexpected error has occurred: '.mysqli_error($con).'")</script>';
            }
        }
        else {
            echo '<script>alert("An unexpected error has occurred.")</script>';
        }
    }
}
?>
