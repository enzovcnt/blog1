<?php

namespace App\Repository;

use App\Entity\Frite;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Frite::class)]
class FriteRepository extends Repository
{

    public function save(Frite $frite): int
    {
        $query = $this->pdo->prepare("INSERT INTO frites (title, content) VALUES (:title, :content)");
        $query->execute([
            'title' => $frite->getTitle(),
            'content' => $frite->getContent()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update(Frite $frite): Frite
    {
        $query = $this->pdo->prepare("UPDATE frites SET title = :title, content = :content WHERE id = :id");
        $query->execute([
            'title' => $frite->getTitle(),
            'content' => $frite->getContent(),
            'id' => $frite->getId()
        ]);
        return $this->find($frite->getId());
    }
}
