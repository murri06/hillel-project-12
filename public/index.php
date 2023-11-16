<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('default log');

$log->pushHandler(new StreamHandler(__DIR__ . '/../log/basic.log', Level::Warning));

$i = 0;
while ($i < 10) {

    if ($i >= random_int(0, 9)) {
        $log->warning('random int is greater than expected.');
    } else {
        $log->error('random int is less than expected.');
    }
    $i++;
}

$handle = fopen(__DIR__ . '/../log/basic.log', 'rb') or die ('File opening failed');

while (!feof($handle)) {
    echo fgets($handle) . '<br>';
}
fclose($handle);
unlink(__DIR__ . '/../log/basic.log');