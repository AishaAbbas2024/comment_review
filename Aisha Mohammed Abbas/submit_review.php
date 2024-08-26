<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "comments_system";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $rating = (int)$_POST['rating'];
    $comment = htmlspecialchars($_POST['comment']);

    $stmt = $conn->prepare("INSERT INTO reviews (name, rating, comment) VALUES $name, $rating, $comment )");
    

    if ($stmt->execute()) {
        echo "New review added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header('Location: index.html');
    exit;
}
?>
