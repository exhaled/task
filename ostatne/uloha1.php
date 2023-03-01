<?php
/*
 * Pre toto riesenie by sme mohli pouzit aj IF/ELSE/ELSEIF
 * ale pride mi viac citatelne a lepsie pre buduce pouzitie vyuzit SWITCH
 *
 * V PHP +8.0 by sme taktiez mohli vyuzit funkciu match co by to este viac zjednodusilo
 *  echo match ($i) {
 *   $i % 15 == 0 => "Primitivo",
 *   $i % 3 == 0 => "Primit",
 *   $i % 5 == 0 => "ivo",
 *   default => $i,
 *  };
 */
for ($i = 1; $i <= 100; $i++) {
    switch ($i) {
        case ($i % 15 == 0):
            echo "Primitivo";
            break;
        case ($i % 3 == 0):
            echo "Primit";
            break;
        case ($i % 5 == 0):
            echo "ivo";
            break;
        default:
            echo $i;
            break;
    }
    echo "\n";
}
