<?php
require_once('inc/Database.php');
require_once('inc/dynamic_elements.php');
require_once('inc/login_db.php');
include('inc/register_db.php');


session_start();
if(!isset($_SESSION['logged_in'])){
header('location: register_login.php');
exit;
}

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'shop_db');
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Retrieve the user’s email from the session
$email = $_SESSION['email'];
$username = 'Guest';

// Query the database to get the username
$stmt = $conn->prepare("SELECT username FROM register WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();

// Store username in the session
$_SESSION['username'] = $username;

$stmt->close();
$conn->close();


// Handle logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
   session_destroy();
   header('location: register_login.php');
   exit;
}

// create instance of Database class
$database = new Database();

if (isset($_POST['add'])){
    /// print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){

        if(in_array($_POST['product_id'], array_keys($_SESSION['cart']))){
            $_SESSION['cart'][$_POST['product_id']] += 1;
            header("location: shop.php");
        }else{
            // Create new session variable
            $_SESSION['cart'][$_POST['product_id']] = 1;
            // print_r($_SESSION['cart']);
            header("location: shop.php");
        }

    }else{
        // Create new session variable
        $_SESSION['cart'][$_POST['product_id']] = 1;
        // print_r($_SESSION['cart']);
        header("location: shop.php");
    }
}

 
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Never Lack ENT.</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/cart.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout inner_page">
   <div id="success-message" class="alert alert-success" style="display: none; position: fixed; top: 20px; right: 20px; z-index: 9999;">
    Product added to cart successfully!
</div>
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <div class="header">
            <div class="container-fluid">
               <div class="row d_flex">
                  <div class=" col-md-2 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="index.php"><img src="images/logo.png" alt="#"/></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-8 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item ">
                                 <a class="nav-link" href="index.php">Home</a>
                              </li>
                              <li class="nav-item active">
                                 <a class="nav-link" href="shop.php">Shop</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="contact.php">Contact Us</a>
                              </li>
                              <li class="nav-item">
                              <a class="nav-link" href="cart.php">Cart</a>
                           </li>
                            <li class="nav-item">
                              <form action="" class="form-inline my-2 my-lg-0" style="border-radius: 5px; border: 1px solid #ccc;">
                                 <input class="from-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="border: 1px #aaa;">
                                 <button class="btn btn-primary" type="submit">Search</button>
                              </form>
                            </li>
                        </div>
                     </nav>
                  </div>
                  <div class="col-md-2">
                  <li style="margin-bottom: 50px;"><?php echo "Welcome, " . htmlspecialchars($username); ?></li>
                     <ul class="email text_align_right d-flex align-items-center" style="gap: 10px; list-style: none;">
                     <li class="d_none"><a href="register_login.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                     <form action="" method="POST" class="mb-0">
                                <button type="submit" name="logout" class="btn btn-secondary">Logout</button>
                            </form>
                           </ul>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end banner -->
      <!-- honey_bg -->
               <div class="container">
               <div class="titlepage text_align_center">
        <h1 class="my-4">Products</h1>
</div>

        <div class="row">
<div class="container">
        <div class="row text-center py-5">
            <?php
                $result = $database->getData();
                if($result){
                    while ($row = $result->fetch_assoc()){
                        prodElement($row);
                    }
                }else{
                    echo "<h4 class='text-center'>No Product Listed Yet<h4>";
                }
            ?>
        </div>
</div>
            <!-- Repeat for more products -->
        </div>
    </div>

            </div>
                  
               </div>
            </div>
         </div>
      </div>
      <!-- end honey_bg -->
      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-3 col-sm-6">
                     <div class="infoma text_align_left">
                        <h3>About</h3>
                        <p class="ipsum">We're the peanut perfectionists,dedicated to crafting products that exceed your expectations and satisfy your cravings.</p>
                        <ul class="social_icon">
                           <li><a href="Javascript:void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                           <li><a href="Javascript:void(0)"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                     <div class="infoma">
                        <h3>Address</h3>
                        <ul class="conta">
                           <li>Tamale, Ghana.
                           </li>
                           <li>(+233) 244407461 <br>(+233) 264444880</li>
                           <li> <a href="Javascript:void(0)"> sayimawsaani@gmail.com</a></li>
                           <li>Nationwide Delivery</li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                     <div class="infoma">
                        <h3>Newsletter</h3>
                        <form class="form_subscri">
                           <div class="row">
                              <div class="col-md-12">
                                 <input class="newsl" placeholder="Your Name" type="text" name="Your Name">
                              </div>
                              <div class="col-md-12">
                                 <input class="newsl" placeholder="Email" type="text" name="Email">
                              </div>
                              <div class="col-md-12">
                                 <button class="subsci_btn">subscribe</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>© 2024 All Rights Reserved.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/custom.js"></script>
      <script>
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                let productId = this.getAttribute('data-id');
                let productName = this.getAttribute('data-name');
                let productPrice = this.getAttribute('data-price');

                // Add to cart (session or local storage, this can be managed in a back-end or front-end approach)
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                cart.push({id: productId, name: productName, price: productPrice});
                localStorage.setItem('cart', JSON.stringify(cart));
                alert(productName + " has been added to your cart.");
            });
        });
    </script>
     <script>
function showSuccessMessage() {
    var successMessage = document.getElementById('success-message');
    successMessage.style.display = 'block';

    // Hide the message after 3 seconds
    setTimeout(function() {
        successMessage.style.display = 'none';
    }, 3000);
}
</script>
   </body>
</html>