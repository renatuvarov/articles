<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ORM\Table(name="articles")
 */
class Article implements JsonSerializable
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
    private $article_title;

    /**
     * @ORM\Column(type="text")
     */
    private $article_description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $article_image;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=true)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleTitle(): ?string
    {
        return $this->article_title;
    }

    public function setArticleTitle(string $article_title): self
    {
        $this->article_title = $article_title;

        return $this;
    }

    public function getArticleDescription(): ?string
    {
        return $this->article_description;
    }

    public function setArticleDescription(string $article_description): self
    {
        $this->article_description = $article_description;

        return $this;
    }

    public function getArticleImage(): ?string
    {
        return $this->article_image;
    }

    public function setArticleImage(string $article_image): self
    {
        $this->article_image = $article_image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'title' => $this->article_title,
            'description' => $this->article_description,
            'image' => $this->article_image,
        ];
    }
}
