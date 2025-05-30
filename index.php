<?php
// filepath: /Users/jeff/Projects/proyecto-cicd/cicd-ia/CICD-IA/index.php
require_once __DIR__ . '/src/App.php';

$app = new App();

$name = $_GET['name'] ?? 'Mundo';
$a = isset($_GET['a']) ? (int)$_GET['a'] : 0;
$b = isset($_GET['b']) ? (int)$_GET['b'] : 0;

echo "<h1>Demo CICD-IA</h1>";
echo "<p>Saludo: " . $app->greet($name) . "</p>";
echo "<p>Suma ($a + $b): " . $app->add($a, $b) . "</p>";
echo "<p>Resta ($a - $b): " . $app->subtract($a, $b) . "</p>";