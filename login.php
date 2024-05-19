<?php
    include 'utilities/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>starlist - Log in</title>

    <!-- Include stylesheets -->
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="login.css">

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Include Javascript -->
    <script src="login.js"></script>

</head>
<body>
    <div class = 'contentBox'>
        <img class = 'logo' src = 'resources/images/starlistLogo.png'>
        <!-- LOGIN CONTAINER -->
        <div class = 'loginBox'>
            <input class = 'usernameBox' placeholder = 'enter your username'></input>
            <input class = 'passwordBox' type = 'password' placeholder = 'enter your password'></input>
            <button onclick = 'login()'> log in </button>
            <p class = 'errorMessage' style = 'display: none'> Error message goes here </p>
            <p class = 'successMessage' style = 'display: none'> Success message goes here </p>
            <div class = 'options'>
                <p class = 'link notAUserLink' onclick = 'switchToSignup()'> Not a User? <br> Create an account. </p>
                <p class = 'link forgotPaswordLink'> Forgot Password? </p>
            </div>
        </div>
        <!-- SIGNUP CONTAINER -->
        <div class = 'signupBox' style = 'display: none'>
            <input class = 'emailBox' placeholder = 'enter your email'></input>
            <input class = 'createdUsernameBox' placeholder = 'create your username'></input>
            <input class = 'createdPasswordBox' type = 'password' placeholder = 'create a password'></input>
            <input class = 'confirmPasswordBox' type = 'password' placeholder = 'confirm your password'></input>
            <button onclick = 'signup()'> create your account </button>
            <p class = 'errorMessage' style = 'display: none'> Error message goes here </p>
            <div class = 'options'>
                <p class = 'link alreadyAUser' onclick = 'switchToLogin()'> Already a User? <br> Login instead. </p>
            </div>
        </div>
    </div>

    

    <!-- STARS -->

    <img class = 'star star1 rotate-center' src = 'resources/images/orangeHollowStar.png'>
    <img class = 'star star2 rotate-center2' src = 'resources/images/orangeHollowStar.png'>
    <img class = 'star star3 rotate-center-reverse' src = 'resources/images/orangeHollowStar.png'>

    <img class = 'shoppingCart slide-right' src = 'resources/images/shoppingcart.gif'>

</body>
</html>