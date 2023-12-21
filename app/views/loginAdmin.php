<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Administrátor</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type='text'],
        input[type='password'] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        input[type='submit'] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #5c6bc0;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type='submit']:hover {
            background-color: #3f51b5;
        }
    </style>
</head>
<body>
<div>
    <h1>Přihlášení</h1>
    {{@error_msg}}

    <form method="post">
        <label for="name">Email: </label>
        <input type="text" name="name" id="name" required><br>

        <label for="pass">Heslo: </label>
        <input type="password" name="pass" id="pass" required><br>

        <input type="submit" value="Přihlásit se">
    </form>
</div>
</body>
</html>
