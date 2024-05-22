<?php
    //Hide PHP errors from being displayed
    //error_reporting(0);
    
    include ("connection.php");

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $itemID = htmlspecialchars($_POST['itemID']);

        $itemName = htmlspecialchars($_POST['itemName']);
        $category = htmlspecialchars($_POST['category']);
        $weightUnit = htmlspecialchars($_POST['weightUnit']);
        $unitType = htmlspecialchars($_POST['unitType']);

        // Array to store prices
        $prices = array();

        // For each price
        for ($i = 1; $i <= 3; $i++) {
            $storeNameKey = 'storeName' . $i;
            $netWeightKey = 'netWeight' . $i;
            $totalPriceKey = 'totalPrice' . $i;

            // Check if store name is not null
            if ($_POST[$storeNameKey] !== null) {
                // Store data
                $priceData = array(
                    'storeName' => htmlspecialchars($_POST[$storeNameKey]),
                    'netWeight' => htmlspecialchars($_POST[$netWeightKey]),
                    'totalPrice' => htmlspecialchars($_POST[$totalPriceKey])
                );

                // Add price data to prices array
                $prices[] = $priceData;
            }
        }

        try {
            $statement = $conn->prepare("UPDATE items SET itemName=?, category=?, unit=?, storeName1=?, netWeight1=?, totalPrice1=?, storeName2=?, netWeight2=?, totalPrice2=?, storeName3=?, netWeight3=?, totalPrice3=?, unitType=? WHERE itemID=?");
            $userID = $_SESSION['loggedInUser'];

            // Bind parameters
            $statement->bind_param('ssssddsddsddsi', $itemName, $category, $weightUnit, $storeName1, $netWeight1, $totalPrice1, $storeName2, $netWeight2, $totalPrice2, $storeName3, $netWeight3, $totalPrice3, $unitType, $itemID);

            // Set parameters
            $itemName = htmlspecialchars($_POST['itemName']);
            $category = htmlspecialchars($_POST['category']);
            $weightUnit = htmlspecialchars($_POST['weightUnit']);
        
            // Loop through prices array
            for ($i = 0; $i < count($prices); $i++) {
                $storeName = 'storeName' . ($i + 1);
                $netWeight = 'netWeight' . ($i + 1);
                $totalPrice = 'totalPrice' . ($i + 1);
                ${$storeName} = htmlspecialchars($_POST[$storeName]);
                ${$netWeight} = htmlspecialchars($_POST[$netWeight]);
                ${$totalPrice} = htmlspecialchars($_POST[$totalPrice]);
            }
        
            // Execute the statement
            $statement->execute();
        } catch (Exception $e) {
            echo "Error editting item: " . $e->getMessage();
        }
    
    }
    //Close connection
    $conn -> close();
?>
