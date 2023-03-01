<?php
// Nacitame class
include('libs/mfcr.class.php');
$mfcr = new MFCR();

// Ziskame udaje o subjekte podla ICO
// Input funkcie musi byt string
$udaje = $mfcr->udaje_subjektu('71214011');

// Akcia funkcia vrati false znamena to ze subjekt nexistuje
if ($udaje) {
    echo 'Názov firmy: ' . $udaje->nazov . PHP_EOL;
    echo 'Typ firmy: ' . $udaje->typ . PHP_EOL;
    echo 'Adresa: ' . $udaje->adresa . PHP_EOL;
    echo 'Počet zamestnancov: ' . $udaje->zamestnanci . PHP_EOL;
} else {
    echo 'Subjekt nebol najdený.';
}