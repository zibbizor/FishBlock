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
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('UserBundle:index.html.twig');
    }
//
//    /**
//     * Ajout d'un utilisateur  [GET ou POST]
//     * @param Request $request
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
//     */
//    public function addAction(Request $request)
//    {
//        $user = new User();
//        $form = $this->createForm(new UserType(), $user);
//        $form->handleRequest($request);
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($user);
//            $em->flush();
//            $flashMessage = "L'utilisateur a bien été ajouté !";
//
//        }
//        return $this->render("UserBundle:index.html.twig", [
//            "form" => $form->createView()
//        ]);
//    }


}
