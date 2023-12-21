<?php
// Zajištění načtení frameworku a modelů
require 'lib/base.php'; // Aktualizujte cestu k F3 frameworku
require 'app/models/kids.php'; // Aktualizujte cestu k modelu Kids

$base = Base::instance();

// Přijetí dat z AJAXového požadavku
$kid = new \models\kids();
$kid->copyfrom('POST');
$kid->save();

echo "Registrace dítěte byla úspěšná.";
?>
