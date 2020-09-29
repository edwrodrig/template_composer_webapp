<?php
declare(strict_types=1);

include_once(__DIR__ . '/../vendor/autoload.php');

$components = ['Button', 'Element', 'Form', 'SectionEasyServices', 'SnackBar', 'TabControls', 'Table', 'TabContents'];

$target_dir = __DIR__ . '/../modules/components/remote';

\labo86\rdtas\Util::downloadJsComponentFiles($target_dir, ...$components);

