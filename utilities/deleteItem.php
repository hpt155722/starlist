<?php
    //Hide PHP errors from being displayed
    error_reporting(0);

    include ("connection.php");

    // Check if itemID is provided
    if(isset($_POST['itemID'])) {

        $statement = $conn->prepare("DELETE FROM items WHERE itemID = ?");
        $statement->bind_param("i", $_POST['itemID']);

        // Execute the statement
        if ($statement->execute()) {
            echo "Item deleted successfully";
        } else {
            echo "Error deleting item: " . $statement->error;
        }

        $statement->close();
        $conn->close();
    } else {
        echo "ItemID not provided";
    }
?>
