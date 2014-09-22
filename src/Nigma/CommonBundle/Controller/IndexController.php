<?php

namespace Nigma\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('NigmaCommonBundle:Default:index.html.twig');
    }
}
