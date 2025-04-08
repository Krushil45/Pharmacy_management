<?php
// Include database connection
require 'C:\xampp\htdocs\Pharmacy-Management\php\db_connection.php';

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $pharmacy_name = trim($_POST['pharmacy_name']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $contact_number = trim($_POST['contact_number']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = "Error: Passwords do not match!";
    } else {
        // Hash password using bcrypt
        $password_hash = $password;

        // Check if username already exists
        $stmt = $con->prepare("SELECT USERNAME FROM admin_credentials WHERE USERNAME = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error_message = "Error: Username already exists!";
        } else {
            $stmt->close();

            // Insert pharmacy details
            $stmt = $con->prepare("INSERT INTO pharmacy_details (pharmacy_name, address, email, contact_number) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $pharmacy_name, $address, $email, $contact_number);
            $stmt->execute();
            $stmt->close();

            // Insert new user into the database
            $stmt = $con->prepare("INSERT INTO admin_credentials (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password_hash);

            if ($stmt->execute()) {
                // Redirect to login after successful signup
                header("Location: login.php");
                exit();
            } else {
                $error_message = "Error: Unable to register user!";
            }
        }
        $stmt->close();
    }
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pharmacy Management - Signup</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="container">
    <div class="card m-auto p-2">
        <div class="card-body">
            <form name="signup-form" class="login-form" action="signup.php" method="POST">
                <div class="logo">
                    <h1 class="logo-caption"><span class="tweak"    >S</span>ign Up</h1>
                    <p class="h5 text-center text-light">Enter your pharmacy and account details</p>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-plus-square text-white"></i></span>
                    </div>
                    <input name="pharmacy_name" type="text" class="form-control" placeholder="Pharmacy Name" required>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-address-card text-white"></i></span>
                    </div>
                    <textarea name="address" class="form-control" placeholder="Address" required></textarea>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope text-white"></i></span>
                    </div>
                    <input name="email" type="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-mobile-alt text-white"></i></span>
                    </div>
                    <input name="contact_number" type="number" class="form-control" placeholder="Contact Number" required>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user text-white"></i></span>
                    </div>
                    <input name="username" type="text" class="form-control" placeholder="Enter Username" required>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock text-white"></i></span>
                    </div>
                    <input name="password" type="password" class="form-control" placeholder="Enter Password" required>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key text-white"></i></span>
                    </div>
                    <input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" required>
                </div>

                <!-- Error Message -->
                <?php if (!empty($error_message)) { ?>
                    <div class="text-danger text-center"><?php echo $error_message; ?></div>
                <?php } ?>

                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-block btn-custom">Sign Up</button>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="text-center">
                <a class="text-light" href="login.php">Already have an account? Login</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
