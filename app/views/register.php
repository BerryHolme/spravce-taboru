<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Registrace</title>
</head>
<body>
<h1>Registrace</h1>
{{@error_msg}}

<form method="post">
    <label for="name">Jméno: </label>
    <input type="text" name="name" id="name" required placeholder="Jméno"><br>

    <label for="surname">Příjmení: </label>
    <input type="text" name="surname" id="surname" required placeholder="Příjmení"><br>

    <label for="email">Email: </label>
    <input type="email" name="email" id="email" required placeholder="vasek@vlaky.cz"><br>

    <label for="password">Heslo: </label>
    <input type="password" name="password" id="password" required placeholder="Heslo"><br>

    <input type="submit" value="Registrovat">
</form>

</body>
</html>
