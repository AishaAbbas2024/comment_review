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
    
    $sql = "SELECT name, rating, comment FROM reviews WHERE id = $id";
    $stmt = $conn->prepare($sql);
    
    $stmt->execute();
    $stmt->bind_result($name, $rating, $comment);
    $stmt->fetch();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Your Review</h1>
        <form id="editForm" method="POST" action="update_review.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="form-group">
                <label for="rating">Rating (1-5):</label>
                <input type="number" id="rating" name="rating" min="1" max="5" value="<?php echo $rating; ?>" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" rows="4" required><?php echo htmlspecialchars($comment); ?></textarea>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
