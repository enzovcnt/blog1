<?php

namespace App\Entity;

use App\Repository\BurgerRepository;
use App\Repository\CommentRepository;
use Attributes\TargetRepository;
use Core\Attributes\Table;

#[Table(name: 'burgers')]
#[TargetRepository(repoName: BurgerRepository::class)]
class Burger
{
    private int $id;

    private string $title;

    private string $content;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getComments():array
    {
        $commentRepo = new CommentRepository();
        return $commentRepo->findAllByPost($this);
    }
}