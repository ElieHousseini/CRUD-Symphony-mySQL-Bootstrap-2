<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/*
> What are those weird things above the $article variable ?
- ORM\ManyToOne(targetEntity=Article::class, inversedBy="comments")
means there is a relation ManyToOne between this class and the class Article.
In other words, $article is a foreign key here refering to the primary key in the 
Article class.The relation ManyToOne means: we can have many comment for one article.
- @ORM\JoinColumn(nullable=false)
means it cannot be null it's a foreign key which is primary in Article table.

> what does inversedBy mean and did I used it ?
inversedBy attribute used with the OneToOne, ManyToOne, or ManyToMany mapping declaration.
mappedBy attribute is used with the OneToOne, OneToMany, or ManyToMany mapping declaration.
You put mappedby into the inverse side of the bidirectional relationship to refer
to it's owning side. 
You put inversedBy into the owning side of a bidirectional relationship to refer to it's 
inverse side.
The owning side of a bidirectional relationship is the side that contains the foreign key.
more info: https://bit.ly/344pROu or this: https://bit.ly/2S5qZM7


*/

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
