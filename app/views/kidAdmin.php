<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Seznam přihlášek</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function denieApp(appId) {
            if (confirm('Opravdu chcete zrušit žádost?')) {
                $.ajax({
                    url: '/denieApp',
                    type: 'POST',
                    data: { id: appId },
                    success: function(response) {
                        $('#appRow' + appId + ' button').attr('onclick', 'acceptApp(' + appId + ')').text('Přimout žádost');
                    },
                    error: function() {
                        alert('Chyba při zastavování přihlašování');
                    }
                });
            }
        }

        function acceptApp(appId) {
            if (confirm('Opravdu chcete přijmout žádost?')) {
                $.ajax({
                    url: '/acceptApp',
                    type: 'POST',
                    data: { id: appId },
                    success: function(response) {
                        $('#appRow' + appId + ' button').attr('onclick', 'denieApp(' + appId + ')').text('Zrušit žádost');
                    },
                    error: function() {
                        alert('Chyba při zahajování přihlašování');
                    }
                });
            }
        }
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #5c6bc0;
            color: white;
        }

        td {
            background-color: #fff;
        }

        button {
            background-color: #5c6bc0;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 5px;
        }

        button:hover {
            background-color: #3f51b5;
        }
    </style>
</head>
<body>
<h1>Seznam přihlášek  pro tábor {{@camp}}</h1>

<table>
    <thead>
    <tr>
        <th>Jméno dítěte</th>
        <th>Datum vytvoření</th>
        <th>Stav</th>
    </tr>
    </thead>
    <tbody>
    <repeat group="{{@apps}}" value="{{@app}}">
        <tr id="appRow{{@app.id}}">
            <td>{{@app.kid}}</td>
            <td>{{@app.time}}</td>
            <td>
                <check if="{{@app.state == 0}}">
                    <true>
                        <button onclick="acceptApp({{@app.id}})">Přijmout žádost</button>
                        <button onclick="denieApp({{@app.id}})">Zrušit žádost</button>
                    </true>

                    <false>
                        <check if="{{@app.state == 1}}">
                            <true>
                                <button onclick="denieApp({{@app.id}})">Zrušit žádost</button>
                            </true>
                            <false>
                                <button onclick="acceptApp({{@app.id}})">Přijmout žádost</button>
                            </false>
                        </check>
                    </false>
                </check>
            </td>
        </tr>
    </repeat>
    </tbody>
</table>

</body>
</html>
