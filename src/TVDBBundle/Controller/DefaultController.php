<?php

namespace TVDBBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Crawler;
use TVDBBundle\Model\TVDB;

class DefaultController extends Controller
{
    /**
     * Request serie data
     *
     * @Route("/requestbase/{name}/{lang}", name="tvdb_requestserie", requirements={"name"="^[a-zA-Z0-9 ]*$"})
     * @Method("GET")
     */
    public function requestSerieAction($name, $lang)
    {
        $tvdb = new TVDB();
        $data = $tvdb->requestSerie($name, $lang);

        //var_dump($data);
        $size = sizeof($data->Series);
        //var_dump($size);

        if ($size == 0)
        {
            $this->addFlash('danger', 'No match found for the criteria.');
            return $this->redirectToRoute('serie_index');
        }

        return $this->render('TVDBBundle:Default:requestserie.html.twig', array(
            'data' => $data,
            'lang' => $lang,
        ));
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
        if ($em->getRepository('SerieBundle:Serie')->findOneBytvdbid($id))
        {
            $this->addFlash('warning', 'The serie already exists.');
            return $this->redirectToRoute('serie_index');
        }
        else
        {
            $tvdb = new TVDB();
            $data = $tvdb->requestDetailedSerie($id, $lang);
            $serie = $tvdb->sortDetailedData($data);

            //var_dump($serie);

            $em->persist($serie);
            $em->flush();
            $this->addFlash('success', 'Serie ' . $serie->getName() . ' has been added.');
        }


        return $this->redirectToRoute('serie_index');
    }

    /**
     * Search for a serie
     *
     * @Route("/search", name="tvdb_search")
     * @Method("GET")
     */
    public function searchSerieAction()
    {
        return $this->render('TVDBBundle:Default:search.html.twig');
    }

    /**
     * Search for a serie
     *
     * @Route("/search", name="tvdb_searchpost")
     * @Method("POST")
     */
    public function searchSeriePostAction(Request $request)
    {
        $term = $request->get('term', 'error');

        if ($term == "error")
        {
            $this->addFlash('danger', 'No match found for the criteria.');
            return $this->redirectToRoute('tvdb_search');
        }

        return $this->redirectToRoute('tvdb_requestserie', array('name' => $term, 'lang' => 'en'));
    }
}
