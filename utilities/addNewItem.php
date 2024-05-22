<?php
    //Hide PHP errors from being displayed
    error_reporting(0);
    
    include ("connection.php");

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $itemName = htmlspecialchars($_POST['itemName']);
        $category = htmlspecialchars($_POST['category']);
        $weightUnit = htmlspecialchars($_POST['weightUnit']);

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
            $statement = $conn->prepare("INSERT INTO items (userID, itemName, category, unit, storeName1, newWeight1, totalPrice1, storeName2, newWeight2, totalPrice2, storeName3, newWeight3, totalPrice3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $userID = $_SESSION['loggedInUser'];

            // Bind parameters
            $statement->bind_param('issdsddsddsdd', $userID, $itemName, $category, $weightUnit, $storeName1, $netWeight1, $totalPrice1, $storeName2, $netWeight2, $totalPrice2, $storeName3, $netWeight3, $totalPrice3);
        
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
            echo "Error adding item: " . $e->getMessage();
        }
    
    }
    //Close connection
    $conn -> close();
?>
