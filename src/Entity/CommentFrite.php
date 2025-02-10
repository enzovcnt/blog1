<?php

namespace App\Entity;

use App\Repository\CommentFriteRepository;
use Attributes\TargetRepository;
use Core\Attributes\Table;

#[Table(name: 'comments_frite')]
#[TargetRepository(repoName: CommentFriteRepository::class)]
class CommentFrite
{
    private int $id;

    private string $content;

    private string $frite_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getPostId(): string
    {
        return $this->frite_id;
    }

    public function setPostId(string $frite_id): void
    {
        $this->frite_id = $frite_id;
    }


}