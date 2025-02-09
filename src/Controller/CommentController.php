<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
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
         if(!empty($_POST['content']) && !empty($_POST['postId']) & ctype_digit($_POST['postId']))
         {
             $id = $_POST['postId'];
             $content = $_POST['content'];
         }
         if(!$id){return $this->redirect();}

         $post = $this->getRepository(Post::class)->find($id);


         if($post && $content)
         {
             $comment = new Comment();
             $comment->setContent($content);
             $comment->setPostId($post->getId());
             $this->getRepository(Comment::class)->save($comment);
         }

         return $this->redirect([
             "type"=>"post",
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


        $postId = $comment->getPostId();
        $this->getRepository()->delete($comment);


        return $this->redirect([
            "type"=>"post",
            "action"=>"show",
            "id"=>$postId
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
                "type"=>"post",
                "action"=>"show",
                "id"=>$comment->getPostId()
            ]);
        }


        return $this->render('comment/update', [
            'comment' => $comment
        ]);
    }
}