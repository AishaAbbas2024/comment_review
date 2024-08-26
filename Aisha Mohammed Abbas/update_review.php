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
    $id = (int)$_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $rating = (int)$_POST['rating'];
    $comment = htmlspecialchars($_POST['comment']);

    $stmt = $conn->prepare("UPDATE reviews SET name =$name , rating = $rating, comment = $comment WHERE id = $id");
   

    if ($stmt->execute()) {
        echo "Review updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header('Location: index.html');
    exit;
}
?>
