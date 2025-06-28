<?php
session_start();
require_once 'inc/Database.php';

$conn = new mysqli('localhost', 'root', '', 'shop_db');
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['transaction_ref'])) {
    $transaction_ref = $_GET['transaction_ref'];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($transaction_ref),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: sk_live_17fa8fcb44bf156b4ce0ac4c4cc77d51c83ffea7", // Replace with your Paystack secret key
            "Cache-Control: no-cache"
        ],
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        die('Curl returned error: ' . $err);
    }

    $transaction = json_decode($response, true);

    if ($transaction['status'] === true && $transaction['data']['status'] === 'success') {
        // Payment was successful
        // Save order details to database or notify admin
        echo "Payment successful. Transaction ID: " . $transaction['data']['id'];

        // Send SMS notification to admin or customer
    } else {
        echo "Payment verification failed.";
    }
} else {
    echo "No transaction reference provided.";
}




if (!isset($_GET['transaction_id'])) {
    die('Transaction ID not provided');
}

$transaction_id = $_GET['transaction_id'];
$user_id = $_SESSION['user_id'] ?? null; // Ensure the user is logged in

if (!$user_id) {
    die('User not logged in');
}

// Fetch the cart details from the session
$cart_items = $_SESSION['cart'] ?? [];
if (empty($cart_items)) {
    die('Cart is empty');
}

$db = new Database();

// Calculate total amount
$total_amount = 0;
foreach ($cart_items as $product_id => $quantity) {
    $result = $db->getData([$product_id]);
    if ($row = $result->fetch_assoc()) {
        $total_amount += $row['current_price'] * $quantity;
    }
}

// Insert order record
$query = "INSERT INTO orders (user_id, total_amount, payment_status, created_at)
          VALUES (?, ?, 'Paid', NOW())";
$stmt = $db->conn->prepare($query);
$stmt->bind_param('id', $user_id, $total_amount);
$stmt->execute();

// Get the order ID
$order_id = $stmt->insert_id;

// Clear the cart
unset($_SESSION['cart']);

// Notify admin via WebSocket or AJAX
?>
<script>
    // Notify admin of the new order via WebSocket or other methods
    fetch('admin_notification.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ order_id: <?php echo $order_id; ?> })
    });
    alert("Order processed successfully!");
    window.location.href = "order_summary.php?order_id=<?php echo $order_id; ?>";
</script>
