<?php

echo "PHP Version: " . phpversion() . "<br>";
echo "Laravel path test<br>";

require __DIR__.'/../vendor/autoload.php';
echo "Autoload OK<br>";

$app = require_once __DIR__.'/../bootstrap/app.php';
echo "Bootstrap OK<br>";

echo "All OK!";
