<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Nástěnka</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e6f2ff; /* Světlá modrá pro pozadí */
            color: #333;
            margin: 0;
            padding: 0;
        }

        .site-header {
            background-color: #3b6978; /* Tmavě mentolová barva */
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        .site-header h1 {
            margin: 0;
        }

        .site-header nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-weight: bold;
        }

        .site-header nav a:hover {
            text-decoration: underline;
        }

        main {
            padding: 20px;
        }

        section {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #3b6978; /* Tmavě mentolová barva */
            color: white;
        }

        input[type="submit"] {
            background-color: #3b6978; /* Tmavě mentolová barva */
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2b4f60;
        }
        /* Styl pro odkazy vypadající jako tlačítka */
        a.button-style {
            background-color: #3b6978; /* Tmavě mentolová barva */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a.button-style:hover {
            background-color: #2b4f60; /* Tmavší odstín pro hover efekt */
            color: white;
            text-decoration: none;
        }

        /* Příklad použití pro navigační odkazy */
        .site-header nav a {
            margin: 0 10px;
            font-weight: bold;
        }

        /* Specifické styly pro navigační odkazy, pokud je chcete mít jako tlačítka */
        .site-header nav a.button-style {
            display: inline-block; /* Umožní padding a další blokové vlastnosti */
            margin: 5px;
        }

    </style>

</head>
<body>
<header class="site-header">
    <h1>Rodič přihlášen jako {{@SESSION.user.name}} {{@SESSION.user.surname}}</h1>


    <nav>
        <a href="/kids" class="button-style">Seznam vašich dětí</a>
        <a href="/appListParent" class="button-style">Seznam přihlášek</a>
        <a href="/logout" class="button-style">Odhlásit se</a>
    </nav>

</header>

<main>
    <section id="childRegistrationForm">
        <h2>Registrovat dítě</h2>
        <form id="childForm" action="/registerKid" method="POST">
            <form id="childForm" action="/registerKid" method="POST">
                Jméno:
                <input type="text" name="name" required><br>

                Příjmení:
                <input type="text" name="surname" required value="{{@SESSION.user.surname}}"><br>

                Datum narození:
                <input type="date" name="birthdate" required><br>

                <input type="submit" id="submitForm" value="Registrovat">
            </form>
        </form>
    </section>

    <section id="campList">
        <h2>Seznam Táborů</h2>

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
                <th>Přihlásit dítě</th>
            </tr>
            </thead>
            <tbody>
            <repeat group="{{@camps}}" value="{{@camp}}">
                <tr>
                    <td>{{@camp.name}}</td>
                    <td>{{@camp.skupina}}</td>
                    <td>{{@camp.placename}}</td>
                    <td>{{@camp.kids}}</td>
                    <td>{{@camp.leaders}}</td>
                    <td>{{@camp.start}}</td>
                    <td>{{@camp.end}}</td>
                    <td>{{@camp.info}}</td>
                    <td>
                        <check if="{{@camp.state == 1}}">
                            <true>
                                Tábor už je obsazen.
                            </true>
                            <false>
                                <form class="campRegistrationForm" action="/registerKidToCamp" method="post">
                                    <select name="kidId" class="kidSelector">
                                        <repeat group="{{@kids}}" value="{{@kid}}">
                                            <option value="{{@kid.id}}">{{@kid.name}} {{@kid.surname}}</option>
                                        </repeat>
                                    </select>
                                    <input type="hidden" name="campId" value="{{@camp.id}}">
                                    <input type="submit" value="Přihlásit">
                                </form>
                            </false>
                        </check>
                    </td>
                </tr>
            </repeat>
            </tbody>
        </table>
    </section>
</main>



<script>


    // Přidání AJAX volání pro odeslání formuláře
    $('#childForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '/registerKid',
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

    $('.registerKidToCamp').on('click', function() {
        var selectedKid = $(this).prev('.kidSelector').val();
        console.log('Tlačítko přihlásit bylo stisknuto');
        if (!selectedKid) {
            alert('Vyberte prosím dítě.');
            return;
        }

        $('.registerKidToCamp').on('click', function() {
            var selectedOption = $(this).prev('.kidSelector').find('option:selected');
            var selectedKid = selectedOption.val().split(' ')[0];
            var selectedCamp = selectedOption.val().split(' ')[1];

            if (!selectedKid || !selectedCamp) {
                alert('Vyberte prosím dítě a tábor.');
                return;
            }
            $('.campRegistrationForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '/registerKidToCamp',
                    data: formData,
                    success: function(response) {
                        // Handle the response here (e.g., display a success message)
                        alert(response);
                    },
                    error: function(error) {
                        // Handle errors here (e.g., display an error message)
                        alert('Chyba při odesílání formuláře: ' + error.responseText);
                    }
                });
            });



</script>
</body>
</html>