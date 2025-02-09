<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Burger;
use Attributes\TargetEntity;
use Core\Repository\Repository;
use PDO;

#[TargetEntity(entityName: Comment::class)]
class CommentRepository extends Repository
{


    public function findAllByPost(Burger $burger): array
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE burger_id = :burger_id");
        $query->execute(['burger_id' => $burger->getId()]);
        $comments = $query->fetchAll(\PDO::FETCH_CLASS, $this->targetEntity);
        return $comments;
    }

    public function save(Comment $comment): int
    {
        $query = $this->pdo->prepare("INSERT INTO $this->tableName (content, burger_id) VALUES (:content, :burger_id)");

        $query->execute([
            'content' => $comment->getContent(),
            'burger_id' => $comment->getPostId(),
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