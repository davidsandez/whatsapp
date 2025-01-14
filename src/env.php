<?php	

namespace Usuario\Prueba;

use Dotenv\Dotenv;


class Env
{
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable('../');
        $dotenv->load();
    }

    public function apply()
    {
        var_dump($_ENV);
    }

}
