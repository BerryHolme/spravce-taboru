<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            background-color: white;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            display: inline-block;
            text-align: left;
        }
        label {
            margin-bottom: 5px;
            display: inline-block;
            font-weight: bold;
        }
        input[type="email"], input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
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
