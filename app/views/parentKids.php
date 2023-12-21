<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Seznam vašich dětí</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function deleteKid(kidId) {
            if (confirm('Opravdu chcete smazat toto dítě?')) {
                $.ajax({
                    url: '/deleteKid',
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
</head>
<body>
<h1>Seznam vašich zaregistrovaných dětí</h1>

<table>
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

</body>
</html>
