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
    <p> HOME PAGE <BR> IMPLEMENT LATER BLAH BLAH </p>
    <img src = 'temp.png'>
</body>
</html>