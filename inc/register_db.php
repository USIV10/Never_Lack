<?php   
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username =  $_POST['username'];
    $phone =     $_POST['phone'];
    $email =     $_POST['email'];
    $password =  $_POST['password'];

    $errors = [];
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

    if (empty($username) || empty($phone) || empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (!preg_match($pattern, $password)) {  
        $errors[] = "Password must contain a minimum length of 8 characters with at least one uppercase letter,
        one lowercase letter, one digit, and one special character.";
    }

    $conn = new mysqli('localhost', 'root', '', 'shop_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM register WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $errors[] = "Username already exists";
    }
    $stmt->close();

    $stmt = $conn->prepare("SELECT * FROM register WHERE email= ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $errors[] = "Email already exists";
    }
    $stmt->close();

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO `register` (username, phone, email, password) VALUES (?, ?, ?, ?)");
        
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Debug: Display the hashed password
        echo "Hashed password for debugging: $hashed_password<br>";

        $stmt->bind_param("ssss", $username, $phone, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('$error')</script>";
        }
        echo "<script>window.location.href='../register_login.php'</script>";
    }

    $conn->close();
}        
?>