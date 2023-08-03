<?php

declare(strict_types=1);

require __DIR__ . "/vendor/autoload.php";

use Resizer\ImageResizer;

$resizer = new ImageResizer(20, 20);
$resizer->resizeAllImages("./dir1");