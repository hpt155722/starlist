<?php
    session_start();

    if (empty($_SESSION['loggedInUser'])) {
        echo "<script> window.location.href = '../../login.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping List</title>

    <!-- Include stylesheets -->
    <link rel="stylesheet" href="../../main.css">
    <link rel="stylesheet" href="home.css">

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Include Javascript -->
    <script src="home.js"></script>
</head>
<body>
    <div class = 'header'>
        <img class = 'menuIcon' src = '../../resources/images/menuIcon.png'>
        <img class = 'shoppingListTitle' src = '../../resources/images/shoppingListTitle.png'>
    </div>

    <!-- Add/Edit item popup  -->
    <div class = 'addEditItem' style = 'display: none' >
        <div class = 'addEditWindow'>
            <!-- Header  -->
            <div class = 'addEditWindowHeader'>
                <p class = 'addEditWindowTitle'> add new item </p>
                <img class = 'exitIcon' onclick = 'addEditItemClose()' src = '../../resources/images/exitIcon.png'>
            </div>

            <div class = 'addEditWindowBody'>
                <!-- Item title  -->
                <p class = 'label'> NAME OF ITEM </p>
                <input class = 'addEditItemName' oninput = 'validateAddEditConfirmButton()' type = 'text' maxlength="25">

                <!-- Item category  -->
                <div class = 'categoryContainer'>
                    <div class = 'categoryTypes'>
                        <label for="categoryType"> Category:</label>
                        <select class="categoryType">
                            <option value="Produce" selected>Produce</option>
                            <option value="Dairy">Dairy</option>
                            <option value="Meat">Meat</option>
                            <option value="Bakery">Bakery</option>
                            <option value="Frozen Foods">Frozen Foods</option>
                            <option value="Pantry">Pantry</option>
                            <option value="Condiments">Condiments and Seasoning</option>
                            <option value="Beverages">Beverages</option>
                            <option value="Snacks">Snacks</option>
                            <option value="Baking Supplies">Baking Supplies</option>
                            <option value="Household Items">Household Items</option>
                            <option value="Personal Care">Personal Care</option>
                            <option value="Pet Supplies">Pet Supplies</option>
                            <option value="Health and Wellness">Health and Wellness</option>
                            <option value="Misc">Misc</option>
                        </select>
                    </div>
                </div>

                <!-- Item unit  -->
                <div class = 'unitContainer'>
                    <div class="unitTypes">
                        <label for="unitType"> Unit Type:</label>
                        <select class="unitType" onchange = 'changeUnits(); calculateUnitWeight(); updateUnitTypeAndUnit();'>
                            <option value="weight" selected>Weight</option>
                            <option value="liquid">Liquid</option>
                        </select>
                    </div>

                    <div class="weightUnits">
                        <label for="weightUnit"> Weight Unit: </label>
                        <select class="weightUnit" onchange='calculateUnitWeight(); updateUnitTypeAndUnit();'>
                            <option value="gram" selected>Gram (g)</option>
                            <option value="kilogram">Kilogram (kg)</option>
                            <option value="ounce">Ounce (oz)</option>
                            <option value="pound">Pound (lb)</option>
                        </select>
                    </div>

                    <div class="liquidUnits" style="display: none;">
                        <label for="liquidUnit"> Liquid Unit: </label>
                        <select class="liquidUnit" onchange='calculateUnitWeight(); updateUnitTypeAndUnit();'>
                            <option value="milliliter" selected>Milliliter (ml)</option>
                            <option value="liter">Liter (l)</option>
                            <option value="fluidOunce">Fluid Ounce (fl oz)</option>
                            <option value="gallon">Gallon (gal)</option>
                        </select>
                    </div>
                </div>
            
                <p class = 'pricesLabel'> PRICES </p>

                
                <div class = 'price1 priceContainer'>
                    <p class = 'cheapestStore' style = 'display: none' > --- CHEAPEST STORE --- </p>
                    <input class = 'storeName' oninput = 'checkAddPriceButton()' type = 'text' maxlength="15" placeholder = 'enter store name'>
                    
                    <div class = 'pricesCalcualtionContainer'>
                        <input class='netWeight' type='number' onchange=' validateNetPrice("weight", this, "price1");' placeholder='enter net weight'>
                        <input class='totalPrice' type='text' onchange=' validateNetPrice("price", this, "price1");' placeholder='enter total price'>
                    </div>
                    <p class = 'unitPrice'> Please fill out information for unit price. </p>
                </div>

                <div class = 'price2 priceContainer'>
                    <p class = 'cheapestStore' style = 'display: none' > --- CHEAPEST STORE --- </p>
                    <input class = 'storeName' oninput = 'checkAddPriceButton()' type = 'text' maxlength="15" placeholder = 'enter store name'>
                    
                    <div class = 'pricesCalcualtionContainer'>
                        <input class='netWeight' type='number' onchange='validateNetPrice("weight", this, "price2");' placeholder='enter net weight'>
                        <input class='totalPrice' type='text' onchange='validateNetPrice("price", this, "price2");' placeholder='enter total price'>
                    </div>
                    <p class = 'unitPrice'> Please fill out information for unit price. </p>
                </div>

                <div class = 'price3 priceContainer'>
                    <p class = 'cheapestStore' style = 'display: none' > --- CHEAPEST STORE --- </p>
                    <input class = 'storeName' oninput = 'checkAddPriceButton()' type = 'text' maxlength="15" placeholder = 'enter store name'>
                    
                    <div class = 'pricesCalcualtionContainer'>
                        <input class='netWeight' type='number' onchange='validateNetPrice("weight", this, "price3");' placeholder='enter net weight'>
                        <input class='totalPrice' type='text' onchange='validateNetPrice("price", this, "price3");' placeholder='enter total price'>
                    </div>
                    <p class = 'unitPrice'> Please fill out information for unit price. </p>
                </div>

                <button class = 'addPrice' onclick = 'addPrice()'> add price+ </button>

                <button class = 'saveAddItemButton' onclick = 'addSaveItemConfirm()'> save item </button>
            </div>
        </div>
    </div>

    <!-- List content body  -->
    <div class = 'contentBody'>
        <!-- Add new item -->
        <div class = 'addNewItemButton' onclick = 'addEditItemOpen("addNewItem")'> add new item+ </div>

        <!-- Error Message -->
        <p class = 'errorMessage' style = 'display: none'> Testing </p>

        <!-- Body of shopping list -->
        <div class = 'shoppingListBody'></div>
    </div>

</body>
</html>