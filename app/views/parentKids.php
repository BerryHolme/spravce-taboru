<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Seznam vašich dětí</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function deleteKid(kidId) {
            if (confirm('Opravdu chcete smazat toto dítě?')) {
                $.ajax({
                    url: 'deleteKid/',
                    type: 'POST',
                    data: { id: kidId },
                    success: function(response) {
                        // Zde můžete aktualizovat UI, např. odstranit řádek tabulky
                        $('#row-' + kidId).remove();
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
    <h1>Seznam vašich zaregistrovaných dětí</h1>
</header>

<main>
    <section>
        <table class="styled-table">
                <thead>
                <tr>
                    <th>Jméno</th>
                    <th>Příjmení</th>
                    <th>Datum narození</th>
                    <th>Smazat dítě</th>
                </tr>
                </thead>
                <tbody>
                <repeat group="{{@kids}}" value="{{@kid}}">
                    <tr id="row-{{@kid.id}}">
                        <td>{{@kid.name}}</td>
                        <td>{{@kid.surname}}</td>
                        <td>{{@kid.birth}}</td>
                        <td>
                            <button onclick="deleteKid({{@kid.id}})">Smazat</button>
                        </td>
                    </tr>
                </repeat>
                </tbody>
        </table>
    </section>
</main>

</body>
</html>
