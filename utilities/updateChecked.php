<?php
    // Hide PHP errors from being displayed
    // error_reporting(0);

    include ("connection.php");

    $itemID = $_POST['itemID'];
    $newChecked = $_POST['newChecked'];

    $sql = "UPDATE items SET checked = ? WHERE itemID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $newChecked, $itemID); // Assuming both are integers, adjust if they are other types

    if ($stmt->execute()) {
        echo "Update successful!";
    } else {
        echo "Error: Unable to update item. Please try again later.";
    }

?>
