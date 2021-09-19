<?php
require('../vendor/autoload.php');
$openapi = \OpenApi\Generator::scan(['../../models']);
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
