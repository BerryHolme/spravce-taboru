<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Admin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function stopCamp(campId) {
            if (confirm('Opravdu chcete zrušit přihlašování?')) {
                $.ajax({
                    url: '/stopCamp',
                    type: 'POST',
                    data: { id: campId },
                    success: function(response) {
                        // Update the status and button in the table row
                        $('#campStatus' + campId).text('Zastaveno');
                        $('#campRow' + campId + ' button').attr('onclick', 'startCamp(' + campId + ')').text('Zahájit přihlašování');
                    },
                    error: function() {
                        alert('Chyba při zastavování přihlašování');
                    }
                });
            }
        }

        function startCamp(campId) {
            if (confirm('Opravdu chcete zahájit přihlašování?')) {
                $.ajax({
                    url: '/startCamp',
                    type: 'POST',
                    data: { id: campId },
                    success: function(response) {
                        // Update the status and button in the table row
                        $('#campStatus' + campId).text('Aktivní');
                        $('#campRow' + campId + ' button').attr('onclick', 'stopCamp(' + campId + ')').text('Zrušit přihlašování');
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

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            color: #333;
        }

        .button, #toggleFormButton, input[type="submit"], button {
            background-color: #5c6bc0;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none; /* Odstranění podtržení u odkazů */
            display: inline-block;
        }

        .button:hover, #toggleFormButton:hover, input[type="submit"]:hover, button:hover {
            background-color: #3f51b5;
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

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
        }

        input[type="text"], input[type="number"], input[type="date"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
<header>
    <h1>Admin</h1>
</header>

<a href="/adminLogout" class="button">Odhlásit se</a>
<button id="toggleFormButton">Vytvořit tábor</button>

<div id="campForm" style="display:none;">
    <form id="form" action="/newcamp" method="post">
        <label for="name">Jméno Tábora:</label>
        <input type="text" id="name" name="name"><br>

        <label for="skupina">Jméno Skupiny:</label>
        <input type="text" id="skupina" name="skupina"><br>

        <label for="place-coordinates">Souřadnice kempu:</label>
        <input type="text" id="place-coordinates" name="place-coordinates"><br>

        <label for="placename">Název kempu:</label>
        <input type="text" id="placename" name="placename"><br>

        <label for="kids">Maximální Počet Dětí:</label>
        <input type="number" id="kids" name="kids"><br>

        <label for="leaders">Počet Vedoucích:</label>
        <input type="number" id="leaders" name="leaders"><br>

        <label for="start">Datum Začátku:</label>
        <input type="date" id="start" name="start"><br>

        <label for="end">Datum Konce:</label>
        <input type="date" id="end" name="end"><br>

        <label for="info">Dodatečné Informace:</label>
        <input type="text" id="info" name="info"><br>

        <input type="submit" value="Vytvořit Tábor">
    </form>
</div>

<h1>Seznam Táborů</h1>

<table>
    <thead>
    <tr>
        <th>Jméno</th>
        <th>Skupina</th>
        <th>Název kempu</th>
        <th>Maximální počet dětí</th>
        <th>Počet vedoucích</th>
        <th>Datum zahájení</th>
        <th>Datum konce</th>
        <th>Více informací</th>
        <th>Stav</th>
        <th>Seznam dětí</th>
    </tr>
    </thead>
    <tbody>
    <repeat group="{{@camps}}" value="{{@camp}}">
        <tr id="campRow{{@camp.id}}">
            <td>{{@camp.name}}</td>
            <td>{{@camp.skupina}}</td>
            <td>{{@camp.placename}}</td>
            <td>{{@camp.kids}}</td>
            <td>{{@camp.leaders}}</td>
            <td>{{@camp.start}}</td>
            <td>{{@camp.end}}</td>
            <td>{{@camp.info}}</td>
            <td>
                <check if="{{@camp.state == 0}}">
                    <true>
                        <button onclick="stopCamp({{@camp.id}})">Zrušit přihlašování</button>
                    </true>

                    <false>
                        <button onclick="startCamp({{@camp.id}})">Zahájit přihlašování</button>
                    </false>
                </check>
            </td>
            <td>
                <form method="post" action="/kidsAdmin">
                    <input type="hidden" name="id" value="{{@camp.id}}">
                    <input type="submit" value="Seznam dětí">
                </form>
            </td>
        </tr>
    </repeat>
    </tbody>
</table>





<script>
    var toggleButton = document.getElementById("toggleFormButton");
    var form = document.getElementById("campForm");
    var formElement = document.getElementById("campCreationForm");

    toggleButton.addEventListener("click", function() {
        var isFormVisible = form.style.display === "block";
        form.style.display = isFormVisible ? "none" : "block";
        toggleButton.textContent = isFormVisible ? "Vytvořit tábor" : "Zavřít";
    });

    $('#form').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '/newcamp',
            data: formData,
            success: function(response) {
                // Zde zobrazíme zprávu získanou ze serveru
                alert(response);
                if (response.includes('úspěšná')) {
                    console.log('Formulář byl úspěšně odeslán', response);
                    // Můžete přidat další logiku, jako je přesměrování
                }
            },
            error: function(error) {
                console.error('Došlo k chybě při odesílání formuláře', error);
                alert('Chyba při odesílání formuláře: ' + error.responseText);
            }
        });
    });
</script>
</body>
</html>
