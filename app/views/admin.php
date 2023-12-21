<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Admin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #campForm {
            display: none;
        }
    </style>
</head>
<body>
<header>
    <h1>Admin</h1>
</header>

<a href="/adminLogout">Odhlásit se</a>
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
