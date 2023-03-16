<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>This is Index</h1>
    <div>
        <form action="/", method="post">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title"><br>
            <label for="content">Content:</label><br>
            <input type="text" id="content" name="content">
            <input type="submit">
        </form>

    </div>
    <div>
        <?php
            if(isset($_SESSION['massages'])) {
                echo $_SESSION['massages'];
            }
        ?>
    </div>
</body>
</html>