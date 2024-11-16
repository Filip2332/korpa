<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Niste uneli id!");
}

require_once "modeli/baza.php";

$idProizvoda = $_GET['id'];

$rezultat = $baza->query("SELECT * FROM proizvodi WHERE id = $idProizvoda");

if ($rezultat->num_rows == 0) {
    die("Ovaj proizvod ne postoji");
}

$proizvod = $rezultat->fetch_assoc();

if (session_status() === PHP_SESSION_NONE) {
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
    <h1><?= $proizvod['ime'] ?></h1>
    <p><?= $proizvod['opis'] ?></p>
    <p>Cena proizovda:<?= $proizvod['cena'] ?></p>
    <p><?= $proizvod['slika'] ?></p>
    <?php if ($proizvod['kolicina'] == 0): ?>
        <p>Nema na stanju</p>
    <?php else: ?>
        <p>Ima na stanju</p>
    <?php endif; ?>

    <?php if (isset($_SESSION['ulogovan'])): ?>

  <form action="korpa.php" method="post">
    <input type="number" name="kolicina" placeholder="Unesite kolicinu proizvoda">
   <input type="hidden" name="id_proizvoda" value="<?=$proizvod['id'] ?>">
    <button> Dodaj u korpu</button>
  </form>

    <?php else: ?>

        <a href="login.php">Kliknite da se ulogujete kako bi dodali u korpu</a>

    <?php endif; ?>
</body>

</html>