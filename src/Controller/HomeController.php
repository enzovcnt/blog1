<?php

namespace App\Controller;

use Core\Controller\Controller;

class HomeController extends Controller
{


    public function coucou()
    {
        return $this->render('home/coucou', []);
    }

    public function accueil(   )
    {
       return $this->render('home/accueil', []);
    }
}