<?php
require "db_connection.php";

if ($con) {
    // Sanitize inputs
    $name = mysqli_real_escape_string($con, ucwords(trim($_GET["name"] ?? '')));
    $packing = mysqli_real_escape_string($con, strtoupper(trim($_GET["packing"] ?? '')));
    $generic_name = mysqli_real_escape_string($con, ucwords(trim($_GET["generic_name"] ?? '')));
    $suppliers_name = mysqli_real_escape_string($con, trim($_GET["suppliers_name"] ?? ''));

    $batch_id = mysqli_real_escape_string($con, strtoupper(trim($_GET["batch_id"] ?? '')));
    
    // Format expiry date to MM/YY
    $raw_expiry = trim($_GET["expiry_date"] ?? '');
    $expiry_date = '';
    if ($raw_expiry !== '') {
        $timestamp = strtotime($raw_expiry);
        if ($timestamp) {
            $expiry_date = date("m/y", $timestamp); // format as MM/YY
        }
    }

    $quantity = intval($_GET["quantity"] ?? 0);
    $mrp = floatval($_GET["mrp"] ?? 0);
    $rate = floatval($_GET["rate"] ?? 0);

    // Validate required fields
    if (
        $name === '' || $packing === '' || $generic_name === '' || $suppliers_name === '' ||
        $batch_id === '' || $expiry_date === '' || $quantity <= 0 || $mrp <= 0 || $rate <= 0
    ) {
        echo "All fields are required and must be valid!";
        exit;
    }

    // Check if medicine already exists
    $query = "SELECT * FROM medicines WHERE UPPER(NAME) = '" . strtoupper($name) . "' 
              AND UPPER(PACKING) = '" . strtoupper($packing) . "' 
              AND UPPER(SUPPLIER_NAME) = '" . strtoupper($suppliers_name) . "'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    if ($row) {
        echo "Medicine $name with $packing already exists by supplier $suppliers_name!";
    } else {
        $query = "INSERT INTO medicines (NAME, PACKING, GENERIC_NAME, SUPPLIER_NAME) 
                  VALUES('$name', '$packing', '$generic_name', '$suppliers_name')";
        $result = mysqli_query($con, $query);

        if ($result) {
            $medicine_id = mysqli_insert_id($con);
            $stock_query = "INSERT INTO medicines_stock (MEDICINE_ID, NAME, BATCH_ID, EXPIRY_DATE, QUANTITY, MRP, RATE)
                            VALUES($medicine_id, '$name', '$batch_id', '$expiry_date', $quantity, $mrp, $rate)";
            $result_stock = mysqli_query($con, $stock_query);

            if ($result_stock) {
                echo "$name added and stock initialized.";
            } else {
                echo "$name added, but stock initialization failed: " . mysqli_error($con);
            }
        } else {
            echo "Failed to add $name: " . mysqli_error($con);
        }
    }
}
?>
