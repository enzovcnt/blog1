<?php

namespace App\Repository;

use App\Entity\CommentFrite;
use App\Entity\Frite;
use Attributes\TargetEntity;
use Core\Repository\Repository;
use PDO;

#[TargetEntity(entityName: CommentFrite::class)]
class CommentFriteRepository extends Repository
{


    public function findAllByPost(Frite $frite): array
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE frite_id = :frite_id");
        $query->execute(['frite_id' => $frite->getId()]);
        $commentsFrite = $query->fetchAll(\PDO::FETCH_CLASS, $this->targetEntity);
        return $commentsFrite;
    }

    public function save(CommentFrite $commentFrite): int
    {
        $query = $this->pdo->prepare("INSERT INTO $this->tableName (content, frite_id) VALUES (:content, :frite_id)");

        $query->execute([
            'content' => $commentFrite->getContent(),
            'frite_id' => $commentFrite->getPostId(),
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update(CommentFrite $commentFrite): CommentFrite | bool
    {
        $query = $this->pdo->prepare("UPDATE $this->tableName SET content = :content WHERE id = :id");
        $query->execute([
            'content' => $commentFrite->getContent(),
            'id' => $commentFrite->getId()
        ]);

        return $this->find($commentFrite->getId());
    }

}