<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['ulogovan'])) {
    die("Morate biti ulogovani");
}

require_once "modeli/baza.php";


$userId = $_SESSION['user_id'];
$rezultat = $baza->query("SELECT * FROM narudzbine WHERE id_korisnika = $userId");
$narudzbine = $rezultat->fetch_all(MYSQLI_ASSOC);
var_dump($narudzbine);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if ($rezultat->num_rows == 0): ?>
        <h1>Nemate nijedan proizvod</h1>
    <?php else: ?>

        <?php foreach ($narudzbine as $narudzbina): ?>

            <div>
                <p>Kolicina: <?= $narudzbina['kolicina'] ?></p>
                <p>Cena: <?= $narudzbina['cena'] ?></p>
            </div>

        <?php endforeach; ?>

    <?php endif; ?>
</body>

</html>