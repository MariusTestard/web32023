<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les formulaires</title>
</head>
<body>
    <form action="welcomePost.php" method="post">
        Name : <input type="text" name="name"><br>
        Email : <input type="text" name="email"><br>

        <input type="submit">
    </form>

    <h1>-----------------------------------------------</h1>

    <form action="welcomeGet.php" method="get">
        NameGet : <input type="text" name="name"><br>
        EmailGet : <input type="text" name="email"><br>

        <input type="submit">
    </form>
</body>
</html>