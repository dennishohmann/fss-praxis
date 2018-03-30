<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Article
 * @ORM\Entity
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid_binary", unique=true)
     * //  ORM\GeneratedValue(strategy="UUID") // @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     *
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    private $publishDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleComment", mappedBy="article")
     */
    private $comments;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param uuid $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
    return $this->content;
    }

    public function setContent($content)
    {
    $this->content = $content;
    }

    public function getPublishDate()
    {
    return $this->publishDate;
    }

    public function setPublishDate(\DateTime $publishDate = null)
    {
    $this->publishDate = $publishDate;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;

    }

    /**
     * @return ArrayCollection|ArticleComment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return mixed $article
     */
    public function addCommment(ArticleComment $comment)
    {
        $this->comments[] = $comment;
        $comment->setArticle($this);

        return $this;
    }

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->comments = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

}