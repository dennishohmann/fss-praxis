<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;


class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }


    public function CreateMainMenu(array $options)
    {
    $menu = $this->factory->createItem('root');
    $menu->setChildrenAttribute('class', 'navbar-nav mr-auto');
    $menu
        ->addChild('Home', array('route' => 'app_homepage'))
        ->setAttributes(array(
            'class' => 'nav-item',
        ))
        ->setLinkAttributes(array(
            'class' => 'nav-link',
            'style' => 'color: #fff',
        ));

    $menu->addChild('Article', array('route' => 'article_list'))
        ->setAttributes(array(
            'class' => 'nav-item',
        ))
        ->setLinkAttributes(array(
            'class' => 'nav-link',
            'style' => 'color: #fff',
        ));

    //// access services from the container!
    //$em = $this->container->get('doctrine')->getManager();
    //// findMostRecent and Blog are just imaginary examples
    //$blog = $em->getRepository('App:Article')->findMostRecent();
    //
    //$menu->addChild('Latest Blog Post', array(
    //'route' => 'blog_show',
    //'routeParameters' => array('id' => $blog->getId())
    //));

    // create another menu item
    $menu->addChild('Schülerliste', array('route' => 'student_index'))
        ->setAttributes(array(
            'class' => 'nav-item',
        ))
        ->setLinkAttributes(array(
            'class' => 'nav-link',
            'style' => 'color: #fff',
        ));
    // you can also add sub level's to your menu's as follows
    $menu['Schülerliste']->addChild('Neuer Schüler', array('route' => 'student_new'))
        ->setAttributes(array(
            'class' => 'nav-item',
        ))
        ->setLinkAttributes(array(
            'class' => 'nav-link',
            'style' => 'color: #fff',
        ));

    // ... add more children

    return $menu;
    }
}