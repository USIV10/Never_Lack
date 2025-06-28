<?php
session_start();
require_once("inc/Database.php");
require_once("inc/dynamic_elements.php");

$db = new Database();

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'shop_db');
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

$query = "SELECT email FROM users WHERE username = ?";
    // Query the database to get the username
$stmt = $conn->prepare("SELECT email FROM register WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();

// Store username in the session
$_SESSION['email'] = $email;

$stmt->close();
$conn->close();
    
  

    if (isset($_GET['action']) && $_GET['action'] == 'removeItem') {
        unset($_SESSION['cart'][$_GET['id']]);
        echo "<script>alert('Product has been Removed from Shopping Cart');</script>";
        echo "<script>window.location = 'cart.php';</script>";
    }
    if (isset($_GET['action']) && $_GET['action'] == "update_qty") {
        $pid = $_GET['pid'];
        $operation = $_GET['operation'];
        if ($operation == "add") {
            $_SESSION['cart'][$pid] += 1;
        } else {
            if ($_SESSION['cart'][$pid] > 1) {
                $_SESSION['cart'][$pid] -= 1;
            }
        }
        header('location: ./cart.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
        session_destroy();
        header('location: register_login.php');
        exit;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Never Lack ENT.</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/cart.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="icon" href="images/fevicon.png" type="image/gif" />
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    </head>
    <body class="main-layout inner_page">
        <header>
            <div class="header">
                <div class="container-fluid">
                    <div class="row d_flex">
                        <div class="col-md-2 col-sm-3 logo_section">
                            <div class="full">
                                <div class="center-desk">
                                    <div class="logo">
                                        <a href="index.php"><img src="images/logo.png" alt="#"/></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-9">
                            <nav class="navigation navbar navbar-expand-md navbar-dark">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarsExample04">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                                        <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                                        <li class="fa fa-cart"><a class="nav-link active" href="cart.php">Cart</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="col-md-2">
        <ul class="email text_align_right">
            <div class="welcome-message">
                <?php 
                if (!empty($username)) {
                    echo "Welcome, " . htmlspecialchars($username); 
                } else {
                    echo "Welcome, Guest";
                }
                ?>
            </div>
            <li class="d_none">
                <a href="Javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i></a>
            </li>
            <?php if (!empty($username)) { ?>
                <form action="" method="POST" class="mb-0">
                    <button type="submit" name="logout" class="btn btn-secondary">Logout</button>
                </form>
            <?php } ?>
        </ul>
    </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <hr>
        <div class="container-fluid">
            <div class="row px-5">
                <div class="col-md-7">
                    <div class="shopping-cart">
                        <hr>

                        <?php
                        $total = 0;
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            $pids = array_keys($_SESSION['cart']);
                            $result = $db->getData($pids);

                            while ($row = $result->fetch_assoc()) {
                                cartItems($row);
                                $quantity = $_SESSION['cart'][$row['id']] ?? 0;
                                $total += $row['current_price'] * $quantity;
                            }
                        } else {
                            echo "<h5>Cart is Empty</h5>";
                        }
                        ?>

                    </div>
                </div>
                <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
        <div class="pt-4">
            <h5>Total</h5>
            <hr>
            <div class="row price-details">
                <div class="col-md-6">
                    <?php
                    $count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                    echo "<h6>Price ($count items)</h6>";
                    ?>
                    <h6>Delivery Charges</h6>
                    <hr>
                    <h6>Amount Payable</h6>
                </div> 
                <div class="col-md-6">
                    <h6>$<?php echo number_format($total, 2); ?></h6>
                    <h6 class="text-success">FREE</h6>
                    <hr>
                    <h6>$<?php echo number_format($total, 2); ?></h6>
                </div>
            </div>
            <!-- Proceed to Pay Button -->
            <div class="d-flex justify-content-center mt-4">
                <button id="proceedToPay" class="btn btn-primary btn-lg rounded-0">Proceed to Pay</button>
                </div>
                </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    document.getElementById('proceedToPay').onclick = function () {
        var handler = PaystackPop.setup({
            key: 'pk_live_983de3a56f20036b7874297934611b9bcdf31912', // Replace with your Paystack public key
            email: '<?php echo htmlspecialchars($email); ?>',
            amount: <?php echo intval($total * 100); ?>, // Amount in kobo (GHS * 100)
            currency: 'GHS',
            ref: 'NL_' + Math.floor((Math.random() * 1000000000) + 1), // Unique transaction reference
            callback: function(response) {
                // Redirect or notify server with transaction details
                alert('Payment successful. Transaction ref: ' + response.reference);
                window.location.href = "payment_success.php?transaction_ref=" + response.reference;
            },
            onClose: function() {
                alert('Payment window closed');
            }
        });
        handler.openIframe();
    }
</script>


        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery-3.0.0.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
    </html>
