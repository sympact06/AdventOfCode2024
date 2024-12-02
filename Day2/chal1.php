<?php
$invoerBestand = './input.txt';
if (!file_exists($invoerBestand)) {
    die("Invoerbestand niet gevonden.");
}

$regels = file($invoerBestand, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (!$regels) {
    die("Mislukt om het invoerbestand te lezen.");
}

function isVeiligRapport($rapport) {
    $niveaus = array_map('intval', explode(' ', $rapport));
    $n = count($niveaus);

    for ($i = 1; $i < $n; $i++) {
        $verschil = abs($niveaus[$i] - $niveaus[$i - 1]);
        if ($verschil < 1 || $verschil > 3) {
            return false;
        }
    }

    $toenemend = true;
    $afnemend = true;
    for ($i = 1; $i < $n; $i++) {
        if ($niveaus[$i] <= $niveaus[$i - 1]) {
            $toenemend = false;
        }
        if ($niveaus[$i] >= $niveaus[$i - 1]) {
            $afnemend = false;
        }
    }

    return $toenemend || $afnemend;
}

function isVeiligMetDemper($rapport) {
    $niveaus = array_map('intval', explode(' ', $rapport));
    $n = count($niveaus);

    for ($i = 0; $i < $n; $i++) {
        $aangepasteNiveaus = $niveaus;
        array_splice($aangepasteNiveaus, $i, 1);
        if (isVeiligRapport(implode(' ', $aangepasteNiveaus))) {
            return true;
        }
    }

    return false;
}

$veiligAantal = 0;

foreach ($regels as $regel) {
    if (isVeiligRapport($regel) || isVeiligMetDemper($regel)) {
        $veiligAantal++;
    }
}

echo "Aantal veilige rapporten: $veiligAantal\n";
?>
