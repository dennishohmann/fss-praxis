<?php
/**
 * Created by PhpStorm.
 * User: denni
 * Date: 26.03.2018
 * Time: 00:32
 */

namespace App\EventListener;


use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class RedirectAfterRegistrationSuccess implements EventSubscriberInterface
{
    use TargetPathTrait;

    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        // main is your firewall's name
        $url = $this->getTargetPath($event->getRequest()->getSession(), 'main');
        if (!$url) {
            $url = $this->router->generate('app_homepage');
        }
        $response = new RedirectResponse($url);
        $event->setResponse($response);
    }
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS=>'onRegistrationSuccess'
        ];
    }

}