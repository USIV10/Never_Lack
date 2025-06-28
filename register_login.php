<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration</title>
<link rel="stylesheet" href="css/register_login.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
<header>
<h1 class="heading">Login/Register</h1>
</header>

<!-- container div -->
<div class="container">

<!-- upper button section to select
        the login or signup form -->
<div class="slider"></div>
<div class="btn">
    <button class="login">Login</button>
    <button class="signup">Signup</button>
</div>

<!-- Form section that contains the
        login and the signup form -->
<div class="form-section">
       <!-- login form -->
       <div class="login-box">
        <form id="login-form" action="./inc/login_db.php"  method="post">
        <input type="email" class="email ele" placeholder="youremail@email.com" name="email">
        <input type="password" class="password ele" placeholder="password" name="password">
        <button class="clkbtn"  value="Login" type="submit">Login</button>
            </form>
    </div>

<!-- signup form -->
    <div class="signup-box">
        <form  id="signup-form" action="./inc/register_db.php" method="post">
        <input type="text"class="name ele" placeholder="Enter your name" name="username">
        <input type="tel"class="tel ele" placeholder="Enter your phone number" name="phone">
        <input type="email" class="email ele" placeholder="youremail@email.com" name="email">
        <input type="password" class="password ele" placeholder="password" name="password">
        <button class="clkbtn" id="sbtn" type="submit" value="Signup">Signup</button>
            </form>
    </div>

    
</div>
</div>
<script>
    let signup = document.querySelector(".signup");
let login = document.querySelector(".login");
let slider = document.querySelector(".slider");
let formSection = document.querySelector(".form-section");


signup.addEventListener("click", () => {
    slider.classList.add("moveslider");
    formSection.classList.add("form-section-move");
});

login.addEventListener("click", () => {
    slider.classList.remove("moveslider");
    formSection.classList.remove("form-section-move");
});
</script>

</body>
</html>
