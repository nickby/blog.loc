<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SiteController extends Controller
{
    public function indexAction()
    {
        return $this->render('BlogBundle:Site:index.html.twig', array(
            // ...
        ));
    }

    public function showAction()
    {
        return $this->render('BlogBundle:Site:show.html.twig', array(
            // ...
        ));
    }

}
