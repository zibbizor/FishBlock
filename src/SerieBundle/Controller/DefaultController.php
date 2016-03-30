<?php

namespace SerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        	
    	$em = $this->getDoctrine()->getManager();
        $series = $em->getRepository('SerieBundle:Serie')->findAll();

        return $this->render('SerieBundle:Default:index.html.twig', array(
            'series' => $series,
        ));
       
    }


}
