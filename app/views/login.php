<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Přihlášení</title>
</head>
<body>
<h1>Přihlášení</h1>
{{@error_msg}}

<form method="post">
    <label for="email">Email: </label>
    <input type="email" name="email" id="email" required placeholder="vasek@vlaky.cz"><br>

    <label for="password">Heslo: </label>
    <input type="password" name="password" id="password" required placeholder="Heslo"><br>

    <input type="submit" value="Přihlásit se">
</form>

</body>
</html>
