<?php

require_once __DIR__ . '/vendor/autoload.php';

$driver_nopass = new Stash\Driver\Redis(
    [
        'servers' => [
            [
              'server'   => 'redis',
              'port'     => 6379
            ]
        ]
    ]
);

$driver_yespass = new Stash\Driver\Redis(
    [
        'servers' => [
            [
              'server'   => 'redis',
              'port'     => 6379,
              'password' => '123abc'
            ]
        ]
    ]
);

$pool_nopass = new Stash\Pool($driver_nopass);
$pool_yespass = new Stash\Pool($driver_yespass);

try {
    $item = $pool_nopass->getItem('/someitem');

    if($item->isHit()) {
       echo "Cache hit.\n";
    } else {
        echo "Cache miss.\n";
    }
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
}

try {
    $item = $pool_yespass->getItem('/someitem');

    if($item->isHit()) {
       echo "Cache hit.\n";
    } else {
        echo "Cache miss.\n";
    }
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
}
