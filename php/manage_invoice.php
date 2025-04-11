<?php

require "db_connection.php";

if (isset($_GET["action"])) {
  $action = $_GET["action"];

  switch ($action) {
    case "delete":
      if (isset($_GET["invoice_number"])) {
        $invoice_number = $_GET["invoice_number"];
        $query = "DELETE FROM invoices WHERE INVOICE_ID = $invoice_number";
        $result = mysqli_query($con, $query);
        if (!empty($result)) showInvoices();
      }
      break;

    case "refresh":
      showInvoices();
      break;

    case "search":
      searchInvoice(strtoupper($_GET["text"]), $_GET["tag"]);
      break;

    case "print_invoice":
      if (isset($_GET["invoice_number"])) {
        printInvoice($_GET["invoice_number"]);
      } else {
        echo "No invoice ID provided.";
      }
      break;

    default:
      echo "Invalid action.";
      break;
  }
}

function showInvoices() {
  global $con;
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showInvoiceRow($seq_no, $row);
    }
  }
}

function showInvoiceRow($seq_no, $row) {
?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['INVOICE_ID']; ?></td>
    <td><?php echo $row['NAME']; ?></td>
    <td><?php echo $row['INVOICE_DATE']; ?></td>
    <td><?php echo $row['TOTAL_AMOUNT']; ?></td>
    <td><?php echo $row['TOTAL_DISCOUNT']; ?></td>
    <td><?php echo $row['NET_TOTAL']; ?></td>
    <td>
      <button class="btn btn-warning btn-sm" onclick="printInvoice(<?php echo $row['INVOICE_ID']; ?>);">
        <i class="fa fa-fax"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="deleteInvoice(<?php echo $row['INVOICE_ID']; ?>);">
        <i class="fa fa-trash"></i>
      </button>
    </td>
  </tr>
<?php
}

function searchInvoice($text, $column) {
  global $con;
  if ($con) {
    $seq_no = 0;
    if ($column == 'INVOICE_ID')
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE CAST(invoices.$column AS CHAR) LIKE '%$text%'";
    else if ($column == "INVOICE_DATE")
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE invoices.$column = '$text'";
    else
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE UPPER(customers.$column) LIKE '%$text%'";

    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showInvoiceRow($seq_no, $row);
    }
  }
}

function printInvoice($invoice_number) {
  global $con;
  if ($con) {
    // Fetch invoice and customer
    $query = "SELECT invoices.*, customers.NAME, customers.ADDRESS, customers.CONTACT_NUMBER, customers.DOCTOR_NAME, customers.DOCTOR_ADDRESS 
              FROM invoices 
              INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID 
              WHERE INVOICE_ID = $invoice_number";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    $customer_name = $row['NAME'];
    $address = $row['ADDRESS'];
    $contact_number = $row['CONTACT_NUMBER'];
    $doctor_name = $row['DOCTOR_NAME'];
    $doctor_address = $row['DOCTOR_ADDRESS'];
    $invoice_date = $row['INVOICE_DATE'];
    $total_amount = $row['TOTAL_AMOUNT'];
    $total_discount = $row['TOTAL_DISCOUNT'];
    $net_total = $row['NET_TOTAL'];

    // Fetch pharmacy/shop info
    $query = "SELECT * FROM admin_credentials";
    $admin_result = mysqli_query($con, $query);
    $admin = mysqli_fetch_array($admin_result);

    $p_name = $admin['PHARMACY_NAME'] ?? 'Pharmacy Name';
    $p_address = $admin['ADDRESS'] ?? 'Pharmacy Address';
    $p_email = $admin['EMAIL'] ?? 'Email';
    $p_contact_number = $admin['CONTACT_NUMBER'] ?? 'Contact';

    ?>
    <!-- STYLES -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">

    <!-- INVOICE HEADER -->
    <div class="row mt-4">
      <div class="col-md-1"></div>
      <div class="col-md-10 h3" style="color: #ff5252;">
        Customer Invoice
        <span class="float-right">Invoice Number: <?php echo $invoice_number; ?></span>
      </div>
    </div>
    <div class="row font-weight-bold">
      <div class="col-md-1"></div>
      <div class="col-md-10"><span class="h4 float-right">Invoice Date: <?php echo $invoice_date; ?></span></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid #ff5252;">
    </div>

    <!-- CUSTOMER AND SHOP INFO -->
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4">
        <span class="h4">Customer Details:</span><br><br>
        <strong>Name:</strong> <?php echo $customer_name; ?><br>
        <strong>Address:</strong> <?php echo $address; ?><br>
        <strong>Contact Number:</strong> <?php echo $contact_number; ?><br>
        <strong>Doctor's Name:</strong> <?php echo $doctor_name; ?><br>
        <strong>Doctor's Address:</strong> <?php echo $doctor_address; ?><br>
      </div>
      <div class="col-md-3"></div>
      <!--<div class="col-md-4">
        <span class="h4">Shop Details:</span><br><br>
        <strong><?php echo $p_name; ?></strong><br>
        <strong><?php echo $p_address; ?></strong><br>
        <strong><?php echo $p_email; ?></strong><br>
        <strong>Mob. No.:</strong> <?php echo $p_contact_number; ?>
      </div>-->
      <div class="col-md-1"></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid #ff5252;">
    </div>

    <!-- ITEM TABLE -->
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 table-responsive">
        <table class="table table-bordered table-striped table-hover" id="purchase_report_div">
          <thead>
            <tr>
              <th>SL</th>
              <th>Medicine Name</th>
              <th>Category</th> <!-- Added -->
              <th>Expiry Date</th>
              <th>Quantity</th>
              <th>MRP</th>
              <th>Discount</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $seq_no = 0;
            $item_query = "SELECT ii.* 
               FROM invoice_items ii 
               WHERE ii.INVOICE_ID = $invoice_number";

            $item_result = mysqli_query($con, $item_query);
            while ($item = mysqli_fetch_array($item_result)) {
              $seq_no++;
              ?>
              <tr>
                <td><?php echo $seq_no; ?></td>
                <td><?php echo $item['MEDICINE_NAME']; ?></td>
          
                <td><?php echo $item['EXPIRY_DATE']; ?></td>
                <td><?php echo $item['QUANTITY']; ?></td>
                <td><?php echo $item['MRP']; ?></td>
                <td><?php echo $item['DISCOUNT'] . "%"; ?></td>
                <td><?php echo $item['TOTAL']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
          <tfoot class="font-weight-bold">
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="7">Total Amount</td>
              <td><?php echo $total_amount; ?></td>
            </tr>
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="7">Total Discount</td>
              <td><?php echo $total_discount; ?></td>
            </tr>
            <tr style="text-align: right; font-size: 22px;">
              <td colspan="7" style="color: green;">Net Amount</td>
              <td class="text-primary"><?php echo $net_total; ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="col-md-1"></div>
    </div>
<?php
  }
}
?>
