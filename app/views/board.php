<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Nástěnka</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header>
    <h1>Rodič přihlášen jako {{@SESSION.user.name}} {{@SESSION.user.surname}}</h1>
</header>

<button id="toggleFormButton">Registrovat Dítě</button>

<div id="childRegistrationForm" style="display:none;">
    <form id="childForm" action="/registerKid" method="POST">
        Jméno:
        <input type="text" name="name" required><br>

        Příjmení:
        <input type="text" name="surname" required value="{{@SESSION.user.surname}}"><br>

        Datum narození:
        <input type="date" name="birthdate" required><br>

        <input type="submit" id="submitForm" value="Registrovat">
    </form>
</div>

<a href="/logout">Odhlásit se</a>
<a href="/kids">Seznam vašich dětí</a>

<script>
    document.getElementById("toggleFormButton").addEventListener("click", function() {
        var form = document.getElementById("childRegistrationForm");
        var button = document.getElementById("toggleFormButton");
        if (form.style.display === "none") {
            form.style.display = "block";
            button.textContent = "Zpět";
        } else {
            form.style.display = "none";
            button.textContent = "Registrovat Dítě";
        }
    });

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

</script>
</body>
</html>