<?php

namespace SerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="s_index")
     */
    public function indexAction()
    {
        	
    	$em = $this->getDoctrine()->getManager();
        $series = $em->getRepository('SerieBundle:Serie')->findAll();

        return $this->render('SerieBundle:Default:index.html.twig', array(
            'series' => $series,
        ));
    }

    /**
     * @Route("/{id}", name="s_detail")
     */
    public function detailAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $serie = $em->getRepository('SerieBundle:Serie')->findOneById($id);

        return $this->render('SerieBundle:Default:detail_serie.html.twig', array(
            'serie' => $serie,
        ));

    }

    /**
     * Search for a serie
     * @Route("/search/", name="s_search")
     * @Method("POST")
     */
    public function searchSerieAction(Request $request)
    {
        $term = $request->get('term', 'error');

        if ($term == "error")
        {
            $this->addFlash('danger', 'No match found for the criteria.');
            return $this->redirectToRoute('s_index');
        }

        $em = $this->getDoctrine()->getManager();
        $series = $em->getRepository('SerieBundle:Serie')->findByName($term);

        if (sizeof($series) == 0)
        {
            $this->addFlash('danger', 'No match found for the criteria.');
            return $this->redirectToRoute('s_index');
        }



        return $this->render('SerieBundle:Default:index.html.twig', array(
            'series' => $series,
        ));
    }

    /**
     * @Route("/{id}/{season}", name="s_detailseason")
     */
    public function detailSeasonAction($id, $season)
    {

        $em = $this->getDoctrine()->getManager();
        $serie = $em->getRepository('SerieBundle:Serie')->findOneById($id);

        return $this->render('SerieBundle:Default:detail_serie_season.html.twig', array(
            'serie' => $serie, 'seasonnumber' => $season,
        ));

    }


}
