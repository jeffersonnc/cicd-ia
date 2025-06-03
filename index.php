<?php
// filepath: /Users/jeff/Projects/proyecto-cicd/cicd-ia/CICD-IA/index.php

// Usar autoloader de Composer en lugar de require_once
require_once __DIR__ . '/vendor/autoload.php';

use App\App;

$app = new App();

$name = $_GET['name'] ?? 'Mundo';
$a = isset($_GET['a']) ? (int)$_GET['a'] : 0;
$b = isset($_GET['b']) ? (int)$_GET['b'] : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo CICD-IA</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 600px; }
        .result { background: #f4f4f4; padding: 15px; margin: 10px 0; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Demo CICD-IA</h1>
        <div class="result">
            <strong>Saludo:</strong> <?= htmlspecialchars($app->greet($name)) ?>
        </div>
        <div class="result">
            <strong>Suma (<?= $a ?> + <?= $b ?>):</strong> <?= $app->add($a, $b) ?>
        </div>
        <div class="result">
            <strong>Resta (<?= $a ?> - <?= $b ?>):</strong> <?= $app->subtract($a, $b) ?>
        </div>
    </div>
</body>
</html>