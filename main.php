<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><BloggersSpot</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="container">
            <h1>BloggersSpot</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="addblogs.php">Add Blog</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </nav>

    <!-- Featured Blog Section -->
    <section class="featured-blog">
        <div class="container">
            <h2>Featured Blog</h2>
            <div class="blog-card">
                <h3>Featured Blog Title</h3>
                <p>Author: Featured Author</p>
                <p>Date: Featured Date</p>
                <p>Featured Blog Content...</p>
                <a href="blog.php?id=1">Read More</a>
            </div>
        </div>
    </section>

    <!-- Recent Blog Posts -->
    <?php
require_once('database.php');

// Fetch recent blog posts from the database
$sql = "SELECT * FROM `blogs` ORDER BY `created_at` DESC LIMIT 2"; // Change the query as needed
$result = $con->query($sql);

?>

<section class="recent-blogs">
    <div class="container">
        <h2>Recent Blog Posts</h2>
        <div class="blog-list">
            <?php
            // Loop through the fetched blog posts and display them
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="blog-card">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p>Author: <?php echo htmlspecialchars(getAuthorName($con, $row['user_id'])); ?></p>
                    <p>Date: <?php echo htmlspecialchars($row['created_at']); ?></p>
                    <p><?php echo htmlspecialchars($row['content']); ?></p>
                   
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<?php
$con->close();

// Function to get the author's name based on user_id
function getAuthorName($con, $user_id) {
    $sql = "SELECT `username` FROM `signup` WHERE `user_id` = '$user_id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['username'];
    }

    return "Unknown Author";
}
?>


    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2023 Your Blog. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
