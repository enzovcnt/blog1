<?php

namespace App\Controller;

use App\Entity\CommentFrite;
use App\Entity\frite;
use Attributes\DefaultEntity;
use Core\Controller\Controller;
use Core\Response\Response;

#[DefaultEntity(entityName: CommentFrite::class)]
class CommentFriteController extends Controller
{

    public function add():Response
    {
         $content = null;
         $id=null;
         if(!empty($_POST['content']) && !empty($_POST['friteId']) & ctype_digit($_POST['friteId']))
         {
             $id = $_POST['friteId'];
             $content = $_POST['content'];
         }
         if(!$id){return $this->redirect();}

         $frite = $this->getRepository(Frite::class)->find($id);


         if($frite && $content)
         {
             $comment = new CommentFrite();
             $comment->setContent($content);
             $comment->setPostId($frite->getId());
             $this->getRepository(CommentFrite::class)->save($comment);
         }

         return $this->redirect([
             "type"=>"frite",
             "action"=>"show",
             "id"=>$id
         ]);
    }


    public function delete():Response
    {
        $id=null;
        if(!empty($_GET['id']) & ctype_digit($_GET['id']))
        {
            $id=$_GET['id'];
        }
        if(!$id){return $this->redirect();}
        $comment = $this->getRepository()->find($id);
        if(!$comment){   return $this->redirect();}


        $friteId = $comment->getPostId();
        $this->getRepository()->delete($comment);


        return $this->redirect([
            "type"=>"frite",
            "action"=>"show",
            "id"=>$friteId
        ]);


    }

    public function update():Response
    {
        $id = null;
        if(!empty($_GET['id']) & ctype_digit($_GET['id']))
        {
            $id=$_GET['id'];
        }

        if(!$id){return $this->redirect();}
        $comment = $this->getRepository()->find($id);
        if(!$comment){   return $this->redirect();}

        $content = null;
        if(!empty($_POST['content']))
        {
            $content = $_POST['content'];

            $comment->setContent($content);
            $this->getRepository()->update($comment);
            return $this->redirect([
                "type"=>"frite",
                "action"=>"show",
                "id"=>$comment->getPostId()
            ]);
        }


        return $this->render('comment/update', [
            'comment' => $comment
        ]);
    }

}