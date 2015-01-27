<?php

namespace Nigma\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->forward('NigmaContentBundle:Pages:staticPage', array(
            'name'  => 'o-nas',
        ));
    }
}
