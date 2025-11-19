<!-- Executed if user comes from the PHP $_POST method -->
<?php if (isset($_POST["nom"])): ?>
<?= "Vous avez acheté une : " . $_POST["nom"] ?>
<?= "<br/>Qui a un prix de : " . $_POST["prix"] ?>
<?= "<br/>Qui provient de : " . $_POST["origine"] ?>
<?= "<br/>Qui avait un stock de : " . $_POST["stock"] ?>
<?php endif; ?>

<!-- Executed if user comes from the JS $_GET method-->
<?php if (isset($_GET["nom"])): ?>
<?= "Vous avez acheté une : " . $_GET["nom"] ?>
<?= "<br/>Qui a un prix de : " . $_GET["prix"] ?>
<?= "<br/>Qui provient de : " . $_GET["origine"] ?>
<?= "<br/>Qui avait un stock de : " . $_GET["stock"] ?>
<?php endif; ?>