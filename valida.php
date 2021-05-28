
<?php
// Ver el ejemplo de password_hash() para ver de dónde viene este hash.
$hash = '$2y$10$o6pfrTd.LJ9WxiR56FUV6OkjEvARun01z3hszzoWzrIc4l0/9W2p.';

if (password_verify('truetrue', $hash)) {
    echo '¡La contraseña es válida!';
} else {
    echo 'La contraseña no es válida.';
}
?>
