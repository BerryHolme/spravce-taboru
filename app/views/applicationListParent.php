<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Seznam přihlášek</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function deleteApp(appId) {
            if (confirm('Opravdu chcete smazat toto dítě?')) {
                $.ajax({
                    url: '/deleteApp',
                    type: 'POST',
                    data: { id: appId },
                    success: function(response) {
                        // Remove the table row on successful deletion
                        $('#appRow' + appId).remove();
                    },
                    error: function() {
                        alert('Chyba při mazání dítěte');
                    }
                });
            }
        }
    </script>

    <style>
        /* Přidáme základní styly jako v předchozím případě */
        body, .site-header, main, section, .styled-table, th, td {
            /* stejné styly jako v předchozím CSS */
        }

        /* Styl pro tabulku */
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 1.5em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #3b6978; /* Tmavě mentolová barva */
            color: white;
            text-align: left;
        }

        .styled-table th, .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #3b6978;
        }

        /* Styly pro tlačítka */
        button {
            background-color: #3b6978; /* Tmavě mentolová barva */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2b4f60; /* Tmavší odstín pro hover efekt */
        }

    </style>
</head>
<body>
<header class="site-header">
    <h1>Seznam přihlášek</h1>
</header>
<main>
    <section>
        <table class="styled-table">
                <thead>
                <tr>
                    <th>Jméno dítěte</th>
                    <th>Tábor</th>
                    <th>Datum vytvoření</th>
                    <th>Stav</th>
                    <th>Smazat přihlášku</th>
                </tr>
                </thead>
                <tbody>
                <repeat group="{{@apps}}" value="{{@app}}">
                    <tr id="appRow{{@app.id}}">
                        <td>{{@app.kid}}</td>
                        <td>{{@app.camp}}</td>
                        <td>{{@app.time}}</td>
                        <td>
                            <check if="{{@app.state == 0}}">
                                <true>Čeká</true>
                                <false>
                                    <check if="{{@app.state == 1}}">
                                        <true>Schváleno</true>
                                        <false>Zamítnuto</false>
                                    </check>
                                </false>
                            </check>
                        </td>
                        <td>
                            <button onclick="deleteApp({{@app.id}})">Zrušit přihlášku</button>
                        </td>
                    </tr>
                </repeat>
                </tbody>
        </table>
    </section>
</main>

</body>
</html>
