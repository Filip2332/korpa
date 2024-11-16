<?php

require_once "modeli/baza.php";


$rezultat = $baza->query("SELECT * FROM proizvodi");
$proizvodi = $rezultat->fetch_all(MYSQLI_ASSOC);


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div>
        <a href="index.php">Glavna</a>

        <?php if (isset($_SESSION['ulogovan'])): ?>
            <a href="logout.php">Logout</a>
            <a href="mojaKorpa.php">Korpa</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>

    <?php foreach ($proizvodi as $proizvod): ?>
        <div>
            <h1><?= $proizvod['ime'] ?></h1>
            <p><?= $proizvod['opis'] ?></p>
            <p>Cena:<?= $proizvod['cena'] ?></p>
            <p><?= $proizvod['slika'] ?></p>
            <p>Na stanju <?= $proizvod['kolicina'] ?> komada</p>

            <?php if ($proizvod['kolicina'] == 0): ?>
                <p>Nema na stanju</p>
            <?php else: ?>
                <p>Ima na stanju</p>
            <?php endif; ?>

            <a href="proizvod.php?id=<?= $proizvod['id'] ?>">Pogledaj proizvod</a>

        </div>
    <?php endforeach; ?>
</body>

</html>