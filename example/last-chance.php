<?php

require_once 'vendor/autoload.php';

use Okaufmann\QwerteePhp\Qwertee;

$lastChance = Qwertee::lastChance();
echo json_encode($lastChance, JSON_PRETTY_PRINT);
