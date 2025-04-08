<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Medicine</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/suggestions.js"></script>
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
    <script>
      function addMedicine() {
    const name = document.getElementById("medicine_name").value;
    const packing = document.getElementById("packing").value;
    const generic_name = document.getElementById("generic_name").value;
    const suppliers_name = document.getElementById("suppliers_name").value;

    const batch_id = document.getElementById("batch_id").value;
    const expiry_date = document.getElementById("expiry_date").value;
    const quantity = document.getElementById("quantity").value;
    const mrp = document.getElementById("mrp").value;
    const rate = document.getElementById("rate").value;

    const url = `php/add_new_medicine.php?name=${encodeURIComponent(name)}&packing=${encodeURIComponent(packing)}&generic_name=${encodeURIComponent(generic_name)}&suppliers_name=${encodeURIComponent(suppliers_name)}&batch_id=${encodeURIComponent(batch_id)}&expiry_date=${encodeURIComponent(expiry_date)}&quantity=${encodeURIComponent(quantity)}&mrp=${encodeURIComponent(mrp)}&rate=${encodeURIComponent(rate)}`;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onload = function () {
        document.getElementById("medicine_acknowledgement").innerText = this.responseText;
    };
    xhr.send();
}

      </script>
  </head>
  <body>
    <div id="add_new_supplier_model">
      <div class="modal-dialog">
      	<div class="modal-content">
      		<div class="modal-header" style="background-color: #ff5252; color: white">
            <div class="font-weight-bold">Add New Supplier</div>
      			<button class="close" style="outline: none;" onclick="document.getElementById('add_new_supplier_model').style.display = 'none';"><i class="fa fa-close"></i></button>
      		</div>
      		<div class="modal-body">
            <?php
              include('sections/add_new_supplier.html');
            ?>
      		</div>
      	</div>
      </div>
    </div>
    <!-- including side navigations -->
    <?php include("sections/sidenav.html"); ?>

    <div class="container-fluid">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('shopping-bag', 'Add Medicine', 'Add New Medicine');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
          <div class="row col col-md-6">
            <?php
              // form content
              require "sections/add_new_medicine.html";
            ?>
          </div>
        </div>

        <hr style="border-top: 2px solid #ff5252;">
        <!-- form content end -->
      </div>
    </div>
  </body>
</html>
