<?php
// Načítame class
include('libs/mfcr.class.php');
$mfcr = new MFCR();

// Získame údaje o subjekte podľa IČO
// Input funkcie musí byt string
$udaje = $mfcr->info_subjektu('71214011');

// Akcia funkcia vráti false znamená to, že subjekt neexistuje
if ($udaje) {
    echo 'Názov firmy: ' . $udaje->nazov . PHP_EOL;
    echo 'Typ firmy: ' . $udaje->typ . PHP_EOL;
    echo 'Adresa: ' . $udaje->adresa . PHP_EOL;
    echo 'Počet zamestnancov: ' . $udaje->zamestnanci . PHP_EOL;
} else {
    echo 'Subjekt nebol najdený.';
}