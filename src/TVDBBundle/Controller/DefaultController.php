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


//        var_dump($data);
//        die;

        return $this->render('TVDBBundle:Default:index.html.twig');
    }

    /**
     * Request serie detail data
     *
     * @Route("/requestdetail/{id}/{lang}", name="tvdb_requestdetailserie")
     * @Method("GET")
     */
    public function requestDetailedSerieAction($id, $lang)
    {
        $em = $this->getDoctrine()->getManager();
        if ($em->getRepository('SerieBundle:Serie')->findOneById($id))
        {
            //serie already exist, TODO
        }
        else
        {
            $tvdb = new TVDB();
            $data = $tvdb->requestDetailedSerie($id, $lang);
            $serie = $tvdb->sortDetailedData($data);

            //var_dump($serie);

            $em->persist($serie);
            $em->flush();
        }

        return $this->render('TVDBBundle:Default:index.html.twig');
    }
}
