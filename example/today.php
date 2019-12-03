<?php

require_once 'vendor/autoload.php';

use Okaufmann\QwerteePhp\Qwertee;

$today = Qwertee::today();
var_dump($today);
