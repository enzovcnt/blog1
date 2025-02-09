<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Post;
use Attributes\TargetEntity;
use Core\Repository\Repository;
use PDO;

#[TargetEntity(entityName: Comment::class)]
class CommentRepository extends Repository
{


    public function findAllByPost(Post $post): array
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE post_id = :post_id");
        $query->execute(['post_id' => $post->getId()]);
        $comments = $query->fetchAll(\PDO::FETCH_CLASS, $this->targetEntity);
        return $comments;
    }

    public function save(Comment $comment): int
    {
        $query = $this->pdo->prepare("INSERT INTO $this->tableName (content, post_id) VALUES (:content, :post_id)");

        $query->execute([
            'content' => $comment->getContent(),
            'post_id' => $comment->getPostId(),
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update(Comment $comment): Comment | bool
    {
        $query = $this->pdo->prepare("UPDATE $this->tableName SET content = :content WHERE id = :id");
        $query->execute([
            'content' => $comment->getContent(),
            'id' => $comment->getId()
        ]);

        return $this->find($comment->getId());
    }

}