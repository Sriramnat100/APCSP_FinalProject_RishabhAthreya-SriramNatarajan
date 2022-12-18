<?php
include 'dbconnection.php';
$conn = connectPostsDB();
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $title = str_replace('"', '\"', $title);

    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $content = str_replace('"', '\"', $content);

    $author = mysqli_real_escape_string($conn, $_POST["author"]);
    $author = str_replace('"', '\"', $author);

    $single_query = "INSERT INTO posts (title, content, author) VALUES ('{$title}', '{$content}', '{$author}')";
    if ($conn->query($single_query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $single_query . "<br>" . $conn->error;
    }

    $conn->close();
?>

<button>redirect</button>

<script>
    document.querySelector("button").addEventListener("click", (e) => {
        window.location = "/createpost.php";
    })
</script>