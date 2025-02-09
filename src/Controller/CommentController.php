<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Burger;
use Attributes\DefaultEntity;
use Core\Controller\Controller;
use Core\Response\Response;

#[DefaultEntity(entityName: Comment::class)]
class CommentController extends Controller
{

    public function add():Response
    {
         $content = null;
         $id=null;
         if(!empty($_POST['content']) && !empty($_POST['burgerId']) & ctype_digit($_POST['burgerId']))
         {
             $id = $_POST['burgerId'];
             $content = $_POST['content'];
         }
         if(!$id){return $this->redirect();}

         $burger = $this->getRepository(Burger::class)->find($id);


         if($burger && $content)
         {
             $comment = new Comment();
             $comment->setContent($content);
             $comment->setPostId($burger->getId());
             $this->getRepository(Comment::class)->save($comment);
         }

         return $this->redirect([
             "type"=>"burger",
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


        $burgerId = $comment->getPostId();
        $this->getRepository()->delete($comment);


        return $this->redirect([
            "type"=>"burger",
            "action"=>"show",
            "id"=>$burgerId
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
                "type"=>"burger",
                "action"=>"show",
                "id"=>$comment->getPostId()
            ]);
        }


        return $this->render('comment/update', [
            'comment' => $comment
        ]);
    }
}