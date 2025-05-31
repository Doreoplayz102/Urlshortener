<?php
require 'db.php';

function generateCode($length = 6) {
    return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $length);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $long_url = trim($_POST['long_url']);

    if (filter_var($long_url, FILTER_VALIDATE_URL)) {
        $code = generateCode();
        $stmt = $pdo->prepare("INSERT INTO urls (long_url, code) VALUES (?, ?)");
        $stmt->execute([$long_url, $code]);

        echo "Short URL: <a href='redirect.php?c=$code'>http://yourdomain.com/redirect.php?c=$code</a>";
    } else {
        echo "Invalid URL!";
    }
}
?>