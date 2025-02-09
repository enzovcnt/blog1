<?php

namespace App\Repository;

use App\Entity\Burger;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Burger::class)]
class BurgerRepository extends Repository
{

    public function save(Burger $burger): int
    {
        $query = $this->pdo->prepare("INSERT INTO burgers (title, content) VALUES (:title, :content)");
        $query->execute([
            'title' => $burger->getTitle(),
            'content' => $burger->getContent()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update(Burger $burger): Burger
    {
        $query = $this->pdo->prepare("UPDATE burgers SET title = :title, content = :content WHERE id = :id");
        $query->execute([
            'title' => $burger->getTitle(),
            'content' => $burger->getContent(),
            'id' => $burger->getId()
        ]);
        return $this->find($burger->getId());
    }
}
