var currentTypeOpened;
var currentUnitType; 
var currentUnit; 
function addItemOpen() {
    currentTypeOpened = "addNewItem";
    $('.addEditWindowTitle').text("add new item");
    $('.saveAddItemButton').html("create item");

    $('.price1').hide();
    $('.price2').hide();
    $('.price3').hide();
    $('.addPrice').show();

    currentUnitType = "weight";
    currentUnit = "gram";
    $('.popUpEntireContainer').css('opacity', 0);
    $('.popUpEntireContainer').show().css('opacity', 100);
    validateAddEditConfirmButton();
}

function updateUnitTypeAndUnit() {
    currentUnitType = $('.unitType').val();
    if (currentUnitType == 'weight') {
        currentUnit = $('.weightUnit').val();
    } else {
        currentUnit = $('.liquidUnit').val();
    }
}

function addEditItemClose() {
    $('.popUpEntireContainer').css('opacity', 0);
    setTimeout(() => {
        $('.addEditItemName').val("");
        $('.popUpEntireContainer').hide();
    }, 400);
}

//If item name is blank, user cannot save
function validateAddEditConfirmButton () {
    if ($('.addEditItemName').val() == "") {
        $('.saveAddItemButton').hide();
    } else {
        $('.saveAddItemButton').show();
    }
}

function checkAddPriceButton() {
    if ($('.price1').is(':visible')) {
        if ($('.price1 > .storeName').val() != "") {
            $('.addPrice').show();
        } 
    } 
    if ($('.price2').is(':visible')) {
        if ($('.price2 > .storeName').val() != "") {
            $('.addPrice').show();
        } 
    } 
    if ($('.price3').is(':visible')) {
        $('.addPrice').hide();
    } 
}

//When user clicks add price
function addPrice() {
    if ($('.price1').is(':hidden')) {
        $('.price1').show();
    } else if ($('.price2').is(':hidden')) {
        $('.price2').show();
    } else if ($('.price3').is(':hidden')) {
        $('.price3').show();
    }
    
    $('.addPrice').hide();
}

function changeUnits() {
    var selectedUnit = $('.unitType').val();
    if (selectedUnit === 'weight') {
      $('.weightUnits').show();
      $('.liquidUnits').hide();
    } else if (selectedUnit === 'liquid') {
      $('.weightUnits').hide();
      $('.liquidUnits').show();
    }
}

function calculateUnitWeight(currentPrice) {
    // Select elements within the current price container
    var totalPrice = $('.' + currentPrice + ' .totalPrice').val();
    var netWeight = $('.' + currentPrice + ' .netWeight').val();
    var storeName = $('.' + currentPrice + ' .storeName').val();

    
    if (!totalPrice || ! netWeight || !storeName) {
        $('.' + currentPrice +'.unitPrice').text("Please fill out information for unit price.");
        return ;
    }

    //Make sure totalPricev and netWeight is not 0s
    if (!totalPrice.match(/[1-9]/)) {
        $('.' + currentPrice + ' .totalPrice').val("");
        totalPrice = '';
    }
    if (netWeight.toString().match(/^0+$/)) {
        $('.' + currentPrice + ' .netWeight').val("");
        netWeight = '';
    }

    if (totalPrice[0] == '$') {
        totalPrice = totalPrice.substring(1);
    } 

    var unit;
    //Calculate unit price to grams
    if (currentUnitType == 'weight') {
        if (currentUnit == 'kilogram') {
            netWeight = netWeight * 1000;
        } else if (currentUnit == 'ounce') {
            netWeight = netWeight * 28.3495231;
        } else if (currentUnit == 'pound') {
            netWeight = netWeight * 453.59237;
        } else { //If in grams
            netWeight = netWeight;
        }
        unit = 'g';
    } else {
        if (currentUnit == 'liter') {
            netWeight = netWeight * 1000;
        } else if (currentUnit == 'fluidOunce') {
            netWeight = netWeight * 29.5735296;
        } else if (currentUnit == 'gallon') {
            netWeight = netWeight * 3785.41178;
        } else { //If in milliliter
            netWeight = netWeight;
        }
        unit = 'ml';
    }

    var unitPrice = totalPrice / netWeight;
    unitPrice = unitPrice.toFixed(4);

    // Remove trailing zeros
    unitPrice = parseFloat(unitPrice).toString();

    $('.' + currentPrice + ' > .unitPrice').text("Unit Price: $" + unitPrice + "/" + unit);
}

function validateNetPrice(type, inputElement, currentPrice) {
    var $inputElement = $(inputElement);
    var value = $inputElement.val().replace(/[^\d.]/g, '');

    if (value === "") { 
        $inputElement.val(""); 
    } else {
        // Remove leading zeros
        value = value.replace(/^0+/, '');
        
        // Remove decimals after the leftmost one
        var indexOfFirstDecimal = value.indexOf('.');
        if (indexOfFirstDecimal !== -1) {
            value = value.substring(0, indexOfFirstDecimal + 1) + value.substring(indexOfFirstDecimal + 1).replace(/\./g, '');
        }

        // Limit to two decimal places
        var parts = value.split('.');
        if (parts.length > 1) {
            parts[1] = parts[1].substring(0, 2); // Take only the first two digits after the decimal point
            value = parts.join('.');
        }
        
        if (type == "price") {
            $inputElement.val('$' + value);
        } else {
            $inputElement.val(value);
        }
    }
    calculateUnitWeight(currentPrice);
}

//When user clicks add item or save item confirm button
function addSaveItemConfirm() {
    if (currentTypeOpened == 'addNewItem') {
        var itemToAdd = {
            itemName: $('.addEditItemName').val(),
            category: $('.categoryType').val(),
            weightUnit: currentUnit,
            unitType: currentUnitType,
            storeName1: $('.price1 .storeName').val() || null,
            netWeight1: $('.price1 .netWeight').val() || null,
            totalPrice1: $('.price1 .totalPrice').val() || null,
            storeName2: $('.price2 .storeName').val() || null,
            netWeight2: $('.price2 .netWeight').val() || null,
            totalPrice2: $('.price2 .totalPrice').val() || null,
            storeName3: $('.price3 .storeName').val() || null,
            netWeight3: $('.price3 .netWeight').val() || null,
            totalPrice3: $('.price3 .totalPrice').val() || null
        };
        
        // Remove '$' from totalPrice if present for all prices
        if (itemToAdd.totalPrice1 && itemToAdd.totalPrice1[0] === '$') {
            itemToAdd.totalPrice1 = itemToAdd.totalPrice1.substring(1);
        }
        if (itemToAdd.totalPrice2 && itemToAdd.totalPrice2[0] === '$') {
            itemToAdd.totalPrice2 = itemToAdd.totalPrice2.substring(1);
        }
        if (itemToAdd.totalPrice3 && itemToAdd.totalPrice3[0] === '$') {
            itemToAdd.totalPrice3 = itemToAdd.totalPrice3.substring(1);
        }
        
        //Send to addNewItem.php
        $.post ('../../utilities/addNewItem.php', itemToAdd, function(response) {
            populateShoppingBody();
            addEditItemClose();
        })
    }
}

//Populate shopping list body with database content
function populateShoppingBody() {
    $.post('../../utilities/loadShoppingList.php', function(data) {
        $('.shoppingListBody').html(data);
    }).fail(function() {
        console.error('Error fetching items');
    });
}

$(document).ready(function() {
    populateShoppingBody();
});

function toggleCheckedAttribute(element) {
    var itemDiv = $(element).parent();
    
    var itemID = itemDiv.attr('itemID');
    
    var checked = itemDiv.attr('dataChecked');

    var newChecked = checked === '0' ? '1' : '0';

    $.post("../../utilities/updateChecked.php", { itemID: itemID, newChecked: newChecked }, function(response) {
        populateShoppingBody();
    });
}

//Edit items
// Loop through each editIcon
function editItemOpen(selectedItem) {
    // Get data attributes
    var itemID = $(selectedItem).attr('itemID');
    var itemName = $(selectedItem).attr('itemName');
    var category = $(selectedItem).attr('category');
    var unit = $(selectedItem).attr('unit');
    var unitType = $(selectedItem).attr('unitType');
    var storeName1 = $(selectedItem).attr('storeName1');
    var netWeight1 = $(selectedItem).attr('netWeight1');
    var totalPrice1 = $(selectedItem).attr('totalPrice1');
    var storeName2 = $(selectedItem).attr('storeName2');
    var netWeight2 = $(selectedItem).attr('netWeight2');
    var totalPrice2 = $(selectedItem).attr('totalPrice2');
    var storeName3 = $(selectedItem).attr('storeName3');
    var netWeight3 = $(selectedItem).attr('netWeight3');
    var totalPrice3 = $(selectedItem).attr('totalPrice3');
    console.log(`
        itemID: ${itemID},
        itemName: ${itemName},
        category: ${category},
        unit: ${unit},
        unitType: ${unitType},
        storeName1: ${storeName1},
        netWeight1: ${netWeight1},
        totalPrice1: ${totalPrice1},
        storeName2: ${storeName2},
        netWeight2: ${netWeight2},
        totalPrice2: ${totalPrice2},
        storeName3: ${storeName3},
        netWeight3: ${netWeight3},
        totalPrice3: ${totalPrice3}
        `);

    //Edit pop up
    currentTypeOpened = "editItem";
    $('.addEditWindowTitle').text("edit item");
    $('.saveAddItemButton').html("save item");

    $('.addEditItemName').val(itemName);
    $('.categoryType').val(category);
    $('.unitType').val(unitType);
    if (unitType == 'weight') {
        $('.weightUnit').val(unit);
        $('.weightUnits').show();
        $('.liquidUnits').hide();
    } else {
        $('.liquidUnit').val(unit);
        $('.weightUnits').hide();
        $('.liquidUnits').show();
    }

    if (storeName1 != "") {
        $('.price1 .storeName').val(storeName1);
        $('.price1 .netWeight').val(netWeight1);
        $('.price1 .totalPrice').val(totalPrice1);
        calculateUnitWeight("price1");
        $('.price1').show();
    } else {
        $('.price1').hide();
    }
    if (storeName2 != "") {
        $('.price2 .storeName').val(storeName2);
        $('.price2 .netWeight').val(netWeight2);
        $('.price2 .totalPrice').val(totalPrice2);
        calculateUnitWeight("price2");
        $('.price2').show();
    } else {
        $('.price2').hide();
    }
    if (storeName3 != "") {
        $('.price3 .storeName').val(storeName3);
        $('.price3 .netWeight').val(netWeight3);
        $('.price3 .totalPrice').val(totalPrice3);
        calculateUnitWeight("price3");
        $('.price3').show();
    } else {
        $('.price3').hide();
    }
    calculateCheapestStore()


    $('.popUpEntireContainer').css('opacity', 0);
    $('.popUpEntireContainer').show().css('opacity', 100);
}

function calculateCheapestStore() {
    var cheapestPrice = Infinity;
    var cheapestPriceName = '';

    // Check if price1 is visible
    if ($('.price1').is(':visible')) {
        var price1UnitPrice = parseFloat($('.price1 .unitPrice').text());
        if (price1UnitPrice < cheapestPrice) {
            cheapestPrice = price1UnitPrice;
            cheapestPriceName = 'price1';
        }
    }

    // Check if price2 is visible
    if ($('.price2').is(':visible')) {
        var price2UnitPrice = parseFloat($('.price2 .unitPrice').text());
        if (price2UnitPrice < cheapestPrice) {
            cheapestPrice = price2UnitPrice;
            cheapestPriceName = 'price2';
        }
    }

    // Check if price3 is visible
    if ($('.price3').is(':visible')) {
        var price3UnitPrice = parseFloat($('.price3 .unitPrice').text());
        if (price3UnitPrice < cheapestPrice) {
            cheapestPrice = price3UnitPrice;
            cheapestPriceName = 'price3';
        }
    }

    // Display the cheapest store
    $(cheapestPriceName + '.cheapestStore').show();
}
