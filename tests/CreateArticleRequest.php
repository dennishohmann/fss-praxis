<?php
namespace App\Service;

use Symfony\Component\Validator\Constraints as Assert;

class CreateArticleRequest
{

/**
* @Assert\NotBlank()
* @Assert\Length(min="10", max="100")
* @var string
*/
public $title;

/**
* @Assert\NotBlank()
* @var string
*/
public $content;

/**
* @Assert\DateTime()
* @var \DateTimeImmutable
*/
public $publishDate;

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @param \DateTimeImmutable $publishDate
     */
    public function setPublishDate(\DateTimeImmutable $publishDate): void
    {
        $this->publishDate = $publishDate;
    }

    public function articleFacade()
    {

    }
}
