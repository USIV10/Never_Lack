<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    if (empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    $conn = new mysqli('localhost', 'root', '', 'shop_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT password FROM register WHERE email = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $email);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Debug: Display the hashed password retrieved from the database
            echo "Hashed password from database: $hashed_password<br>";

            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['logged_in'] = true; 
                $_SESSION['email'] = $email;
                header("Location: ../shop.php"); 
                exit;
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found.";
        }

        $stmt->close();
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }

    $conn->close();
}
?>