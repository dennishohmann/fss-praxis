<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Article
 * @ORM\Entity
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * @var Ramsey\Uuid
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
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
}