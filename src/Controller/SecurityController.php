<?php

namespace App\Controller;

use App\Entity\User;
use Attributes\DefaultEntity;
use Core\Controller\Controller;
use Core\Response\Response;

#[DefaultEntity(entityName: User::class)]
class SecurityController extends Controller
{

    public function register():Response
    {
        $username = null;
        $password = null;
        if(
            !empty($_POST['username']) &&
                !empty($_POST['password'])
        )
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
        }
        if($username & $password)
        {
            if($this->getRepository()->findByUsername($username))
            {

                return $this->redirect([
                    "type"=>"security",
                    "action"=>"register"
                ]);
            }

            $user = new User();
            $user->setUsername($username);
            $user->setPassword($password);

            $this->getRepository()->save($user);
            return $this->redirect([
                "type"=>"security",
                "action"=>"login"
            ]);


        }

        return $this->render('user/signup',[]);
    }


    public function login():Response
    {
        $username = null;
        $password = null;
        if(!empty($_POST['username']) && !empty($_POST['password']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
        }
        if($username & $password)
        {
            $registeredUser = $this->getRepository()->findByUsername($username);
            if(!$registeredUser){return $this->redirect(["type"=>"security","action"=>"login"]);}


            $success = $registeredUser->logIn($password);

            if(!$success){return $this->redirect(["type"=>"security","action"=>"login"]);}
            else{return $this->redirect(["type"=>"post", "action"=>"index"]);}


        }



        return $this->render('user/signin',[]);
    }


    public function logOut():Response
    {
        $user = $this->getUser();
        if($user){$user->logOut();}

        return $this->redirect(["type"=>"post", "action"=>"index"]);
    }

}