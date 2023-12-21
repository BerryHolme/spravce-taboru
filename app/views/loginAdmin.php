<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Administrátor</title>
</head>
<body>
<h1>Přihlášení</h1>
{{@error_msg}}

<form method="post">
    <label for="name">Email: </label>
    <input type="text" name="name" id="name" required><br>

    <label for="pass">Heslo: </label>
    <input type="password" name="pass" id="pass" required><br>

    <input type="submit" value="Přihlásit se">
</form>

</body>
</html>
