<?php
session_start();
require_once 'inc/Database.php'; // Update with your DB connection file

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'shop_db');
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Fetch orders with successful payments
$query = "SELECT o.order_id, r.username, r.phone, o.total_amount, o.created_at 
          FROM orders o
          JOIN register r ON o.user_id = r.id
          WHERE o.payment_status = 'Paid'
          ORDER BY o.created_at DESC";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Admin Orders</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Total Amount</th>
                    <th>Order Date</th>
                    <th>Notify</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['order_id']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['phone']; ?></td>
                        <td><?= $row['total_amount']; ?></td>
                        <td><?= $row['created_at']; ?></td>
                        <td>
                            <form method="post" action="send_notification.php">
                                <input type="hidden" name="phone" value="<?= $row['phone']; ?>">
                                <input type="hidden" name="order_id" value="<?= $row['order_id']; ?>">
                                <input type="hidden" name="amount" value="<?= $row['total_amount']; ?>">
                                <button type="submit" class="btn btn-primary">Send SMS</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
