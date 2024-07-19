<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blogs</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="addblogs.css">
   
    
</head>
<body>

<div class="container">
    <form action="addblogs.php" method="post">
        <label for="title">Title of the blog</label>
        <input type="text" name="title" id="title" placeholder="Enter a catchy title">

        <label for="category">Select a category</label>
        <select name="category" id="category">
            <option value="weather/climate">Weather/Climate</option>
            <option value="india">India</option>
            <option value="educational">Educational</option>
            <option value="sports">Sports</option>
            <option value="space">Space</option>
            <option value="literature">Literature</option>
            <option value="fictional">Fictional</option>
            <option value="entertainment">Entertainment</option>
            <option value="political">Political</option>
            <option value="other">Other</option>
        </select>

        <label for="checkbox">
  <input type="checkbox" name="disable_comments" id="disable_comments">Disable Commnents
</label>


        <label for="content">Content of the blog</label>
        <textarea name="content" id="content" cols="30" rows="10" placeholder="Write your blog content here"></textarea>

        <button class="btn">Submit</button>
    </form>
</div>

<?php
require_once('database.php');
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Access the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Rest of your code
    $title = $_POST['title'];
    $category = $_POST['category'];
    $comments = isset($_POST['disable_comments']) ? 1 : 0;
    $content = $_POST['content'];

    $sql = "INSERT INTO `blogs` (`user_id`, `title`, `category`, `disable_comments`, `content`) VALUES ('$user_id', '$title', '$category', '$comments', '$content')";

    if ($con->query($sql) == true) {
        echo "Blog added successfully";
    } else {
        echo "Error occurred";
    }
}

$con->close();
?>

</body>
</html>
