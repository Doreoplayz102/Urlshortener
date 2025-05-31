<?php
require 'db.php';

$code = $_GET['c'] ?? '';

if ($code) {
    $stmt = $pdo->prepare("SELECT long_url FROM urls WHERE code = ?");
    $stmt->execute([$code]);
    $row = $stmt->fetch();

    if ($row) {
        header("Location: " . $row['long_url']);
        exit();
    } else {
        echo "URL not found.";
    }
} else {
    echo "Invalid request.";
}
?>