<?php

namespace TVDBBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DomCrawler\Crawler;
use TVDBBundle\Model\TVDB;

class DefaultController extends Controller
{
    /**
     * Request serie data
     *
     * @Route("/requestbase/{name}/{lang}", name="tvdb_requestserie")
     * @Method("GET")
     */
    public function requestSerieAction($name, $lang)
    {
        $tvdb = new TVDB();
        $data = $tvdb->requestSerie($name, $lang);


        var_dump($data);
        die;

        return $this->render('TVDBBundle:Default:index.html.twig');
    }
}
