<?php
namespace App\Service;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateArticleRequest
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

    public static function fromArticle(Article $article): self
    {
        $articleRequest = new self();
        $articleRequest->title = $article->getTitle();
        $articleRequest->content = $article->getContent();

        return $articleRequest;
    }
}