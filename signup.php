<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$number = $_POST['number'];

if (empty($firstname) || empty($lastname) || empty($gender) || empty($email) || empty($password) || empty($confirmPassword) || empty($number)) {
    echo "Error: All fields are required!";
    exit();
}

if ($password !== $confirmPassword) {
    echo "Error: Passwords do not match!";
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'test');
if ($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registration(firstname, lastname, gender, email, password, number)
        VALUES(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $firstname, $lastname, $gender, $email, $password, $number);
    $stmt->execute();
    echo "Registered Successfully!";
    $stmt->close();
    $conn->close();

    header('Location: home.html');
    exit();
}
?>
