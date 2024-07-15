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
<?php
include('db.php'); // Include your database connection file here
session_start();

$token = isset($_GET['token']) ? htmlspecialchars($_GET['token']) : '';
$token_hash = hash("sha256", $token);

// Query to retrieve user based on the token hash
$sql = "SELECT * FROM users WHERE reset_token_hash = '$token_hash'";
$result = mysqli_query($con, $sql);

if (!$result) {
    // Handle query error
    echo "<script>alert('Error: ". mysqli_error($con) ."');window.location.href = 'login.php';</script>";
    exit;
}

$user = mysqli_fetch_assoc($result);

if ($user === null) {
    // If no user is found with the token
    echo "<script>alert('Token is not found');window.location.href = 'login.php';</script>";
    exit;
} 

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    // If the token has expired
    echo "<script>alert('Token has expired');window.location.href = 'login.php';</script>";
    exit;
} 

// Process form submission for resetting password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset_password_submit"])) {
    $new_token = $_POST["token"];
    $new_token_hash = hash("sha256", $new_token);
    
    // Verify token again before proceeding
    $sql = "SELECT * FROM users WHERE reset_token_hash = '$new_token_hash'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        // Handle query error
        echo "<script>alert('Error: ". mysqli_error($con) ."');window.location.href = 'login.php';</script>";
        exit;
    }

    $user = mysqli_fetch_assoc($result);

    if ($user === null) {
        // If no user is found with the token after form submission
        echo "<script>alert('Token is not found');window.location.href = 'login.php';</script>";
        exit;
    }

    if (strtotime($user["reset_token_expires_at"]) <= time()) {
        // If the token has expired after form submission
        echo "<script>alert('Token has expired');window.location.href = 'login.php';</script>";
        exit;
    }
    
    // Validate password complexity and match
    $password = $_POST["password"];
    $password_confirmation = $_POST["password_confirmation"];

    if (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters.');window.location.href = 'reset.php?token=$new_token';</script>";
        exit;
    } elseif (!preg_match('/[A-Za-z]/', $password)) {
        echo "<script>alert('Password must contain at least one letter.');window.location.href = 'reset.php?token=$new_token';</script>";
        exit;
    } elseif (!preg_match('/\d/', $password)) {
        echo "<script>alert('Password must contain at least one number.');window.location.href = 'reset.php?token=$new_token';</script>";
        exit;
    } elseif ($password !== $password_confirmation) {
        echo "<script>alert('Passwords do not match.');window.location.href = 'reset.php?token=$new_token';</script>";
        exit;
    }

    // Hash the new password
    $password_hash = hash('sha256', $password);

    // Get the user ID
    $user_id = $user['UserID']; // Adjust this according to your user ID column name

    // Prepare the update query
    $update_sql = "UPDATE users SET Password = '$password_hash', reset_token_hash = NULL, reset_token_expires_at = NULL WHERE UserID = $user_id";

    // Execute the update query
    $update_result = mysqli_query($con, $update_sql);

    if ($update_result) {
        // Password updated successfully, redirect to login page
        echo "<script>alert('Password updated successfully! You can now Login.'); window.location.href = 'login.php';</script>";
        exit;
    } else {
        // Handle update error
        echo "<script>alert('Error updating password.'); window.location.href = 'login.php';</script>";
        exit;
    }


}
?>
<video autoplay loop muted plays-inline class="back-video">
    <source src="assets/assets_customer/img/background-video.mp4" type="video/mp4">
</video>
<main>
    <div class="box">
        <div class="inner-box">
            <div class="forms-wrap">
                <form autocomplete="off" id="resetForm" method="POST"  class="sign-in-form">
                    <div class="logo"></div>
                    <div class="heading">
                        <h2>Let's Sort It</h2>
                        <h6>Changed Your Mind?</h6>
                        <a href="login.php" class="toggle">Return Here</a>
                    </div>
                    <div class="actual-form">
                        <input type="hidden" class="input-field" name="token" value="<?= $token ?>" required />
                        <div class="input-wrap">
                            <input type="password" class="input-field" name="password" required />
                            <label>New Password</label>
                        </div>
                        <div class="input-wrap">
                            <input type="password" class="input-field" name="password_confirmation" required />
                            <label>Repeat Password</label>
                        </div>
                        <input type="submit" name="reset_password_submit" value="Reset Password" class="sign-btn"/>
                    </div>
                    <p class="text">
                        By resetting, I agree to Terms of Services and Privacy Policy
                    </p>
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
<script>
    // JavaScript for preventing right-click on video
    document.addEventListener('contextmenu', function(event) {
        event.preventDefault();
    });
    
    // JavaScript to handle toggle link
    document.querySelector('.toggle').addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = 'login.php';
    });
</script>
</body>
</html>
