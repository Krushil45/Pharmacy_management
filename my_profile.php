<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Admin Profile</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/sidenav.css">
  <link rel="stylesheet" href="css/home.css">
  <script src="js/my_profile.js"></script>
  <script src="js/validateForm.js"></script>
  <script src="js/restrict.js"></script>
</head>
<body>

<!-- including side navigations -->
<?php include("sections/sidenav.html"); ?>

<div class="container-fluid">
  <div class="container">
    
    <!-- Header section -->
    <?php
      require "php/header.php";
      createHeader('user', 'Profile', 'Manage Admin Details');

      require "php/db_connection.php";
      $pharmacy_name = $address = $email = $contact_number = $username = "Not Set";

      if ($con) {
        // Get pharmacy details
        $query = "SELECT * FROM pharmacy_details LIMIT 1";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $pharmacy_name = $row['PHARMACY_NAME'] ?? 'Not Set';
          $address = $row['ADDRESS'] ?? 'Not Set';
          $email = $row['EMAIL'] ?? 'Not Set';
          $contact_number = $row['CONTACT_NUMBER'] ?? 'Not Set';
        }

        // Get admin username
        $query2 = "SELECT USERNAME FROM admin_credentials LIMIT 1";
        $result2 = mysqli_query($con, $query2);
        if ($result2 && mysqli_num_rows($result2) > 0) {
          $row2 = mysqli_fetch_assoc($result2);
          $username = $row2['USERNAME'] ?? 'Not Set';
        }

      } else {
        echo "<script>alert('Database connection failed');</script>";
      }
    ?>

    <div class="row">
      <div class="row col col-md-6">

        <div class="row col col-md-12">
          <div class="col col-md-12 form-group">
            <label class="font-weight-bold" for="pharmacy_name">Pharmacy Name :</label>
            <input id="pharmacy_name" type="text" class="form-control" value="<?php echo $pharmacy_name; ?>" onkeyup="validateName(this.value, 'pharmacy_name_error');" disabled>
            <code class="text-danger small font-weight-bold float-right mb-2" id="pharmacy_name_error" style="display: none;"></code>
          </div>
        </div>

        <div class="row col col-md-12">
          <div class="col col-md-12 form-group">
            <label class="font-weight-bold" for="address">Address :</label>
            <textarea id="address" class="form-control" onkeyup="validateAddress(this.value, 'address_error');" style="max-height: 100px;" disabled><?php echo $address; ?></textarea>
            <code class="text-danger small font-weight-bold float-right mb-2" id="address_error" style="display: none;"></code>
          </div>
        </div>

        <div class="row col col-md-12">
          <div class="col col-md-12 form-group">
            <label class="font-weight-bold" for="email">Email :</label>
            <input id="email" type="email" class="form-control" value="<?php echo $email; ?>" onkeyup="notNull(this.value, 'email_error');" disabled>
            <code class="text-danger small font-weight-bold float-right mb-2" id="email_error" style="display: none;"></code>
          </div>
        </div>

        <div class="row col col-md-12">
          <div class="col col-md-12 form-group">
            <label class="font-weight-bold" for="contact_number">Contact Number :</label>
            <input id="contact_number" type="number" class="form-control" value="<?php echo $contact_number; ?>" onkeyup="validateContactNumber(this.value, 'contact_number_error');" disabled>
            <code class="text-danger small font-weight-bold float-right mb-2" id="contact_number_error" style="display: none;"></code>
          </div>
        </div>

        <div class="row col col-md-12">
          <div class="col col-md-12 form-group">
            <label class="font-weight-bold" for="username">Username :</label>
            <input id="username" type="text" class="form-control" value="<?php echo $username; ?>" onkeyup="notNull(this.value, 'username_error');" disabled>
            <code class="text-danger small font-weight-bold float-right mb-2" id="username_error" style="display: none;"></code>
          </div>
        </div>

        <!-- horizontal line -->
        <div class="col col-md-12">
          <hr class="col-md-12 float-left" style="padding: 0px; width: 95%; border-top: 2px solid  #02b6ff;">
        </div>

        <!-- form buttons -->
        <div class="row col col-md-12 m-auto" id="edit">
          <div class="col col-md-2 form-group float-right"></div>
          <div id="edit_button" class="col col-md-4 form-group float-right">
            <button class="btn btn-primary form-control font-weight-bold" onclick="edit();">EDIT</button>
          </div>
          <div id="password_button" class="col col-md-4 form-group float-right">
            <a href="change_password.php" class="btn btn-warning form-control font-weight-bold">Change Password</a>
          </div>
        </div>

        <div class="row col col-md-12 m-auto" id="update_cancel" style="display: none;">
          <div class="col col-md-2 form-group float-right"></div>
          <div id="cancel_button" class="col col-md-4 form-group float-right">
            <button class="btn btn-danger form-control font-weight-bold" onclick="edit(true);">CANCEL</button>
          </div>
          <div id="update_button" class="col col-md-4 form-group float-right">
            <button class="btn btn-success form-control font-weight-bold" onclick="updateAdminDetails();">UPDATE</button>
          </div>
        </div>

        <!-- success message -->
        <div id="admin_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"></div>

      </div>
    </div>

    <hr style="border-top: 2px solid #ff5252;">
  </div>
</div>
</body>
</html>
