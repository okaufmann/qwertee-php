<?php

require_once 'vendor/autoload.php';

use Okaufmann\QwerteePhp\Qwertee;

$today = Qwertee::lastChance();
echo json_encode($today, JSON_PRETTY_PRINT);
