<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "comments_system";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, rating, comment, created_at, updated_at FROM reviews ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="review">';
        echo '<div class="name">' . htmlspecialchars($row['name']) . '</div>';
        echo '<div class="rating">Rating: ' . htmlspecialchars($row['rating']) . '/5</div>';
        echo '<div class="text">' . htmlspecialchars($row['comment']) . '</div>';
        echo '<div class="time">Posted on: ' . htmlspecialchars($row['created_at']) . '</div>';
        if ($row['created_at'] != $row['updated_at']) {
            echo '<div class="time">Updated on: ' . htmlspecialchars($row['updated_at']) . '</div>';
        }
        echo '<div class="actions">';
        echo '<form action="edit_review.php" method="POST" style="display:inline-block;">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<button type="submit">Edit</button>';
        echo '</form>';
        echo '<form action="delete_review.php" method="POST" style="display:inline-block;">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<button type="submit" class="delete">Delete</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "<p>No reviews yet.</p>";
}

$conn->close();
?>
