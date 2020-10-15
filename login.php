<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pagina</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div id= "frm">
    <form action="process.php" method="POST">
        <p>
            <label>Usernname: </label>
            <input type="text" id= "user" name="user"   />
        </p>
        <p>
            <label>Password: </label>
            <input type="password" id= "pass" name="pass"   />
        </p>
        <p>
            <input type="submit" id= "btn" value="Login"   />
        </p>
    </form>

    </div>
</body>
</html>