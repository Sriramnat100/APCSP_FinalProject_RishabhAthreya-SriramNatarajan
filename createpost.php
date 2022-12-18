<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        div {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }

        form > * {
            display: block;
            width: 100%;
            margin-bottom: 1em;
        }

        form > textarea {
            resize: none;
            height: 5em;
        }

        form > input[type="submit"] {
            width: 40%;
            margin: 0 auto;
        }

        form {
            text-align: center;
            width: 40%;
        }
    </style>
</head>
<body>
    <div>
        <form action="createp-post.php" method="POST">
            <input type="text" placeholder="title" name="title">
            <textarea type="text" placeholder="content" name="content"></textarea>
            <input type="text" placeholder="author" name="author">
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>