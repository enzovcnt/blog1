<?php

namespace App\Controller;

use App\Entity\Burger;
use Attributes\DefaultEntity;
use Core\Controller\Controller;
use Core\Response\Response;

#[DefaultEntity(entityName: Burger::class)]
class BurgerController extends Controller
{
    public function index(): Response
    {

        $theBurgers =  $this->getRepository()->findAll();

        return $this->render('burger/index', [
            'burgers' => $theBurgers,
        ]);
    }


    public function show(): Response
    {
        $id = null;
        if(!empty($_GET["id"]) && ctype_digit($_GET["id"])){
            $id = $_GET["id"];
        }

        if(!$id)
        {
            return $this->redirect([
                "type"=>"burger",
                "action"=>"index"
            ]);
        }

        $burger = $this->getRepository()->find($id);

        if(!$burger)
        {
            return $this->redirect();
        }


        return $this->render('burger/show', [
            'burger' => $burger
        ]);
    }

    public function create(): Response
    {
        $title = null;
        $content = null;
        if(!empty($_POST["title"]) && !empty($_POST["content"])){
            $title = $_POST["title"];
            $content = $_POST["content"];
        }
        if ($title && $content)
        {
            $burger = new Burger();
            $burger->setTitle($title);
            $burger->setContent($content);
            $id = $this->getRepository()->save($burger);

            return $this->redirect([
                "type"=>"burger",
                "action"=>"show",
                "id" => $id
            ]);
        }


        return $this->render('burger/create', []);
    }



    public function delete(): Response
    {
        $id = null;
        if(!empty($_GET["id"]) && ctype_digit($_GET["id"])){
            $id = $_GET["id"];
        }

        if(!$id)
        {
            return $this->redirect([
                "type"=>"burger",
                "action"=>"index"
            ]);
        }

        $burger = $this->getRepository()->find($id);

        if($burger)
        {
            $this->getRepository()->delete($burger);
        }

        return $this->redirect();

    }


    public function update(): Response
    {
        $id = null;
        if(!empty($_GET["id"]) && ctype_digit($_GET["id"])){
            $id = $_GET["id"];
        }

        if(!$id)
        {
            return $this->redirect([
                "type"=>"burger",
                "action"=>"index"
            ]);
        }

        $burger = $this->getRepository()->find($id);

        if(!$burger)
        {
            return $this->redirect();
        }

        $title = null;
        $content = null;
        if(!empty($_POST["title"]) && !empty($_POST["content"])){
            $title = $_POST["title"];
            $content = $_POST["content"];
        }
        if ($title && $content)
        {

            $burger->setTitle($title);
            $burger->setContent($content);
            $updatedBurger = $this->getRepository()->update($burger);

            return $this->redirect([
                "type"=>"burger",
                "action"=>"show",
                "id" => $updatedBurger->getId()
            ]);
        }



        return $this->render('burger/update', [
            'burger' => $burger,
        ]);
    }


}