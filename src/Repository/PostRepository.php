<?php

namespace App\Repository;

use App\Entity\Post;
use Attributes\TargetEntity;
use Core\Repository\Repository;

#[TargetEntity(entityName: Post::class)]
class PostRepository extends Repository
{

    public function save(Post $post): int
    {
        $query = $this->pdo->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
        $query->execute([
            'title' => $post->getTitle(),
            'content' => $post->getContent()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update(Post $post): Post
    {
        $query = $this->pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
        $query->execute([
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'id' => $post->getId()
        ]);
        return $this->find($post->getId());
    }
}