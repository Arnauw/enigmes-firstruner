<?php

/**
 * Fonction culture de masse
 */
function disasterFunction(int $depth = 1): void {
    echo "=== Depth: $depth ===\n";

    // Création d'un tableau 2D massif
    $matrix = [];
    for ($i = 0; $i < 1000; $i++) {
        $row = [];
        for ($j = 0; $j < 1000; $j++) {
            $row[] = rand(min: 1, max: 1000) * rand(min: 1, max: 1000);
        }
        $matrix[] = $row;
    }

    $sum = 0;
    foreach ($matrix as $row) {
        foreach ($row as $value) {
            $sum += sqrt(num: $value) * rand(min: 1, max: 5);
        }
    }

    $str = "";
    foreach ($matrix as $row) {
        $str .= implode(separator: ",", array: $row) . "\n";
    }
    // echo $str; // Commenté pour éviter le crash immédiat, mais pourrait être réactivé
    echo $str;

    echo "Depth $depth: Computed sum = $sum\n";

    disasterFunction(depth: $depth + 1);
}

// Appel initial
// disasterFunction(); // ⚠️ Ne pas lancer en production
disasterFunction();