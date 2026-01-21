<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Walidacja</title>
</head>
<body>

<?php

$rows = [
    " Jan   Kowalski ; JAN.KOWALSKI@Example.com ; 600 123 456 ; 75-200 ; 2026-01-20 ; 18:30 ",
    "Ala Nowak; ala.nowak@example.com; 501-222-333; 00-001; 2026-01-13; 08:00",
    "Piotr; piotr@example.com; 600123456; 75-200; 2026-01-15; 12:00",
    "Ewa K.; ewa@example.com; 600123456; 75-200; 2026-01-15; 12:00",
    "Ola Żółć; ola.zolc@example.com; 123456789; 75-200; 2026-02-30; 10:00",
    "Marek Nowak; marek.nowak@; 600123456; 75-200; 2026-01-10; 09:00",
    "Kasia Wróbel; kasia@wp.pl; 60012345; 75-200; 2026-01-14; 07:30",
    "Paweł-Adam Test; pawel@test.com; +48 600 111 222; 75200; 2026-01-14; 07:30",
    "Anna Maria; anna.maria@example.com; 600111222; 75-200; 2026-01-14; 7:30",
    "Tomek Nowak; tomek.nowak@example.com; 600111222; 75-200; 2026-13-01; 12:00",
    "Zuzanna Łęcka; zuzia@example.com; 600111222; 75-200; 2026-01-14; 23:61",
    "  Janina   Nowak-Kowalska ; janina@ex.com ; 600111222 ; 75-200 ; 2026-01-14 ; 00:05 ",
];

$ok = 0;
$nook = 0;

foreach ($rows as $row) {

    $err = [];

    $data = explode(';', $row);

    if (count($data) !== 6) {
        echo "[BŁĄD] Niepoprawny format linii<br>";
        $nook++;
        continue;
    }

    $imie = trim($data[0]);
    $email = trim($data[1]);
    $tel = trim($data[2]);
    $pocz = trim($data[3]);
    $dat = trim($data[4]);
    $vreme = trim($data[5]);

    $imie = preg_replace('/\s+/', ' ', $imie);
    if (!preg_match('/^[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż-]+\s+[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż-]+$/u', $imie)) {
        $err[] = 'imię i nazwisko';
    }

    $email = strtolower($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err[] = 'email';
    }

    $tel = preg_replace('/[^0-9]/', '', $tel);
    if (strlen($tel) !== 9) {
        $err[] = 'telefon';
    }

    if (!preg_match('/^\d{2}-\d{3}$/', $pocz)) {
        $err[] = 'kod pocztowy';
    }

    $dt = DateTime::createFromFormat('Y-m-d', $dat);
    if (!$dt || $dt->format('Y-m-d') !== $dat) {
        $err[] = 'data';
    }

    if (!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $vreme)) {
        $err[] = 'godzina';
    }

    if (empty($err)) {
        echo "[OK] $imie | $email | $tel | $pocz | $dat $vreme<br>";
        $ok++;
    } else {
        echo "[BŁĄD] " . implode(', ', $err) . "<br>";
        $nook++;
    }
}

echo "<br><strong>Poprawne:</strong> $ok, <strong>Błędne:</strong> $nook";

?>

</body>
</html>