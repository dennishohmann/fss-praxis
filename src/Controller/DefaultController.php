<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends BaseController
{
    /**
     * @Route("/encore", name="homepage")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('lift');
    }
}
