<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use UserBundle\Entity\User;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="s_panel")
     */
    public function indexAction()
    {
        return $this->render('UserBundle:Profile:panel.html.twig');
    }
}