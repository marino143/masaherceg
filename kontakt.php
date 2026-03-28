<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

$ime     = htmlspecialchars(trim($_POST['ime'] ?? ''));
$email   = htmlspecialchars(trim($_POST['email'] ?? ''));
$paket   = htmlspecialchars(trim($_POST['paket'] ?? ''));
$poruka  = htmlspecialchars(trim($_POST['poruka'] ?? ''));

if (!$ime || !$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.html?status=greska');
    exit;
}

$prima  = 'hercegmasa7@gmail.com';
$tema   = "Nova rezervacija — $paket";
$tijelo = "Ime: $ime\nEmail: $email\nPaket: $paket\n\nPoruka:\n$poruka";

$zaglavlja  = "From: noreply@masaherceg.hr\r\n";
$zaglavlja .= "Reply-To: $email\r\n";
$zaglavlja .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($prima, $tema, $tijelo, $zaglavlja)) {
    header('Location: index.html?status=ok');
} else {
    header('Location: index.html?status=greska');
}
exit;
