<?php

namespace App\Controller;

use App\Entity\Frite;
use Attributes\DefaultEntity;
use Core\Controller\Controller;
use Core\Response\Response;


#[DefaultEntity(entityName: Frite::class)]
class FriteController extends Controller
{

    public function index(): Response
    {

        $theFrites =  $this->getRepository()->findAll();

        return $this->render('frite/index', [
            'frites' => $theFrites,
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
                "type"=>"frite",
                "action"=>"index"
            ]);
        }

        $burger = $this->getRepository()->find($id);

        if(!$burger)
        {
            return $this->redirect();
        }


        return $this->render('frite/show', [
            'frite' => $burger
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
            $frite = new Frite();
            $frite->setTitle($title);
            $frite->setContent($content);
            $id = $this->getRepository()->save($frite);

            return $this->redirect([
                "type"=>"frite",
                "action"=>"show",
                "id" => $id
            ]);
        }


        return $this->render('frite/create', []);
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
                "type"=>"frite",
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
                "type"=>"frite",
                "action"=>"index"
            ]);
        }

        $frite = $this->getRepository()->find($id);

        if(!$frite)
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

            $frite->setTitle($title);
            $frite->setContent($content);
            $updatedFrite = $this->getRepository()->update($frite);

            return $this->redirect([
                "type"=>"frite",
                "action"=>"show",
                "id" => $updatedFrite->getId()
            ]);
        }



        return $this->render('frite/update', [
            'frite' => $frite,
        ]);
    }


}