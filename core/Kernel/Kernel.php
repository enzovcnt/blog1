<?php

namespace Core\Kernel;

use Core\Environment\DotEnv;
use Core\Session\Session;

class Kernel
{

    public static function run()
    {
        Session::start();

        $dotEnv = new Dotenv();

        $landingController =$dotEnv->getVariable('LANDING_CONTROLLER');
        $landingMethod =$dotEnv->getVariable('LANDING_METHOD');



        $type = $landingController;
        $action = $landingMethod;
        if(!empty($_GET['type'])){ $type = $_GET['type']; }
        if(!empty($_GET['action'])){ $action = $_GET['action']; }


        $type = ucfirst($type); // Article
        $controllerName = "App\Controller\\".$type."Controller";

        $controller = new $controllerName();
        $controller->$action();
    }


}