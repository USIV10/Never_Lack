<?php
require_once 'inc/Database.php'; // Update with your DB connection file
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'shop_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use the PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email']; // Customer's email (if available from the form)
    $order_id = $_POST['order_id'];
    $amount = $_POST['amount'];

    // Email to admin
    $adminEmail = 'usivabdulkarim@gmail.com'; // Replace with admin's email address
    $subject = "Payment Successful - Order #$order_id";
    $emailMessage = "Dear Admin,\n\nAn order has been successfully processed.\n\nOrder ID: $order_id\nAmount: $$amount\n\nThank you.";

    // Send email to admin
    sendEmail($adminEmail, $subject, $emailMessage);

    // Optionally, send an email to the customer confirming the payment
    if ($email) {
        $customerSubject = "Payment Confirmation - Order #$order_id";
        $customerMessage = "Dear Customer,\n\nThank you for your purchase!\n\nOrder ID: $order_id\nAmount: $$amount\n\nYour payment has been successfully processed.";

        sendEmail($email, $customerSubject, $customerMessage);
    }

    echo "<script>alert('Notification sent successfully!'); window.location.href='admin_orders.php';</script>";
}

// Function to send email using PHPMailer
function sendEmail($to, $subject, $message) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // SMTP server (e.g., smtp.gmail.com for Gmail)
    $mail->SMTPAuth = true;
    $mail->Username = 'usivabdulkarim@gmail.com'; // Your email address
    $mail->Password = 'Charlie11@'; // Your email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Set email details
    $mail->setFrom('usivabdulkarim@gmail.com', 'Never Lack ENT');
    $mail->addAddress($to); // Recipient's email
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = nl2br($message);

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Email sent successfully to $to.";
    }
}
?>
