<?php 

namespace Usuario\Prueba;

require_once '../vendor/autoload.php';

new Env();


$resource = new Whatsapp();
$resource->apply();