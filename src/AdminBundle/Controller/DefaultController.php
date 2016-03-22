<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SerieBundle\Entity\Serie;
use SerieBundle\Entity\Season;
use SerieBundle\Entity\Episode;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:Dashboard:index.html.twig');
    }

    /**
     * Lists all Serie entities.
     *
     * @Route("/series", name="serie_index")
     * @Method("GET")
     */
    public function seriesIndexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $series = $em->getRepository('SerieBundle:Serie')->findAll();

        return $this->render('AdminBundle:Dashboard:series.html.twig', array(
            'series' => $series,
        ));
    }

    /**
     * Details of a serie
     *
     * @Route("/series/{id}", name="serie_detail")
     * @Method("GET")
     */
    public function seriesDetailAction()
    {

        return $this->render('AdminBundle:Dashboard:series.html.twig');
    }

    /**
     * Delete a serie
     *
     * @Route("/series/delete/{id}", name="serie_delete")
     * @Method("GET")
     */
    public function seriesDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $serie = $em->getRepository('SerieBundle:Serie')->findOneById($id);

        $em->remove($serie);
        $this->addFlash('danger', $serie->getName() . ' has been deleted.');
        $em->flush();

        return $this->redirectToRoute('serie_index');
    }

    /**
     * Edit a serie
     *
     * @Route("/series/edit/{id}", name="serie_edit")
     * @Method("GET")
     */
    public function seriesEditAction()
    {
        return $this->render('AdminBundle:Dashboard:series.html.twig');
    }

    /**
     * Approve or Unapprove a serie
     *
     * @Route("/series/approve/{id}", name="serie_approve")
     * @Method("GET")
     */
    public function seriesApproveAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $serie = $em->getRepository('SerieBundle:Serie')->findOneById($id);

        if ($serie->getAdminApproved())
        {
            $serie->setAdminApproved(false);
            $this->addFlash('warning', $serie->getName() . ' has been unapproved.');
            $em->flush();
        }
        else
        {
            $serie->setAdminApproved(true);
            $this->addFlash('success', $serie->getName() . ' has been approved.');
            $em->flush();
        }

        return $this->redirectToRoute('serie_index');
    }
}
