<?php
    //Hide PHP errors from being displayed
    error_reporting(0);


    include ("connection.php");

    session_start();

    $search = "SELECT * FROM items WHERE userID = ?";
    $statement = $conn -> prepare($search);
    $statement -> bind_param("s", $_SESSION['loggedInUser']);
    $statement -> execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        // Initialize an array to store items grouped by category
        $itemsByCateogory = array();
    
        // Group items by category
        while($row = $result->fetch_assoc()) {
            $category = $row["category"];
            if (!isset($itemsByCateogory[$category])) {
                $itemsByCateogory[$category] = array();
            }
            $itemsByCateogory[$category][] = $row;
        }
    
        // Loop through each category and its items
        foreach ($itemsByCateogory as $category => $items) {
            // Print category heading
            echo "<p class='categoryLabel' style='text-transform: uppercase;'>$category</p>";
    
            // Print items
            foreach ($items as $item) {
                if ($item['checked'] == 0) { //If unchecked
                    echo "<div class='item' itemID='" . $item['itemID'] . "' dataChecked='" . $item['checked'] . "'>";
                        echo "<img class='checkbox' src='../../resources/images/uncheckedBox.png' onclick='toggleCheckedAttribute(this)'>";
                } else {
                    echo "<div class='item checked' itemID='" . $item['itemID'] . "' dataChecked='" . $item['checked'] . "'>";
                        echo "<img class='checkbox' src='../../resources/images/checkedBox.png' onclick='toggleCheckedAttribute(this)'>";
                }
                echo "<p class = 'itemName'>" . $item["itemName"] . "</p>";
                echo "<img class='editIcon' onclick = 'editItemOpen(this);' 
                    itemID='" . ($item['itemID'] ?? 'null') . "' 
                    itemName='" . ($item['itemName'] ?? 'null') . "' 
                    category='" . ($item['category'] ?? 'null') . "' 
                    unit='" . ($item['unit'] ?? 'null') . "' 
                    unitType='" . ($item['unitType'] ?? 'null') . "' 
                    storeName1='" . ($item['storeName1'] ?? 'null') . "' 
                    netWeight1='" . ($item['netWeight1'] ?? 'null') . "' 
                    totalPrice1='" . ($item['totalPrice1'] ?? 'null') . "' 
                    storeName2='" . ($item['storeName2'] ?? 'null') . "' 
                    netWeight2='" . ($item['netWeight2'] ?? 'null') . "' 
                    totalPrice2='" . ($item['totalPrice2'] ?? 'null') . "' 
                    storeName3='" . ($item['storeName3'] ?? 'null') . "' 
                    netWeight3='" . ($item['netWeight3'] ?? 'null') . "' 
                    totalPrice3='" . ($item['totalPrice3'] ?? 'null') . "' 
                    src='../../resources/images/editIcon.png'>";
                echo "</div>";

            }
        }
    } else {
        echo "0 results";
    }
    
    // Close statement and connection
    $statement->close();
    $conn->close();
    
?>