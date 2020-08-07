<?php

namespace autoEcoleAdminBundle\Controller;

use autoEcoleBundle\Entity\Moniteur;
use autoEcoleBundle\Entity\Voiture;
use autoEcoleBundle\Form\MoniteurType;
use autoEcoleBundle\Form\VoitureType;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $voitureCount = 0;
        $moniteurCount = 0;
        $revenus = 0;
        try {
            $voitureCount = $em->getRepository('autoEcoleBundle:Voiture')->countAll();
            $moniteurCount = $em->getRepository('autoEcoleBundle:Moniteur')->countAll();
            $entrainementCount = $em->getRepository('autoEcoleBundle:Entrainement')->countAll();
            $revenus = $em->getRepository('autoEcoleBundle:Entrainement')->revenus();
        } catch (DBALException $e) {
            var_dump($e);
            die();
        }
        return $this->render('autoEcoleAdminBundle:Default:index.html.twig',
            array("user"=>$user,"voitureCount"=>$voitureCount,"moniteurCount"=>$moniteurCount,
                "reservationCount"=>$entrainementCount,"revenus"=>$revenus));
    }

    public function listVoitureAction()
    {
        $user = $this->getUser();
        $em=$this->getDoctrine()->getManager();
        $voitures = $em->getRepository('autoEcoleBundle:Voiture')->findAll();
        return $this->render('autoEcoleAdminBundle:Voiture:liste.html.twig',array("user"=>$user,"voitures"=>$voitures));
    }


    public function addVoitureAction(Request $request)
    {
        $user = $this->getUser();
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class,$voiture);
        $em=$this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('auto_ecole_admin_voiture_liste');
        }
        return $this->render('autoEcoleAdminBundle:Voiture:ajouter.html.twig',array("user"=>$user,"form"=>$form->createView()));
    }

    public function deleteMoniteurAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $voiture = $em->getRepository('autoEcoleBundle:Moniteur')->findOneById($id);
        $em->remove($voiture);
        $em->flush();
        return $this->redirectToRoute('auto_ecole_admin_moniteur_liste');
    }

    public function deleteVoitureAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $voiture = $em->getRepository('autoEcoleBundle:Voiture')->findOneById($id);
        $em->remove($voiture);
        $em->flush();
        return $this->redirectToRoute('auto_ecole_admin_voiture_liste');
    }

    public function addMoniteurAction(Request $request)
    {
        $user = $this->getUser();
        $moniteur = new Moniteur();
        $form = $this->createForm(MoniteurType::class,$moniteur);
        $em=$this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em->persist($moniteur);
            $em->flush();
            return $this->redirectToRoute('auto_ecole_admin_moniteur_liste');
        }
        return $this->render('autoEcoleAdminBundle:Moniteur:ajouter.html.twig',array("user"=>$user,"form"=>$form->createView()));
    }

    public function listMoniteurAction()
    {
        $user = $this->getUser();
        $em=$this->getDoctrine()->getManager();
        $moniteurs = $em->getRepository('autoEcoleBundle:Moniteur')->findAll();
        return $this->render('autoEcoleAdminBundle:Moniteur:liste.html.twig',array("user"=>$user,"moniteurs"=>$moniteurs));
    }

    public function updateMoniteurAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        $moniteur = $em->getRepository('autoEcoleBundle:Moniteur')->findOneById($id);
        $form = $this->createForm(MoniteurType::class,$moniteur);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em->merge($moniteur);
            $em->flush();
            return $this->redirectToRoute('auto_ecole_admin_moniteur_liste');
        }
        return $this->render('autoEcoleAdminBundle:Moniteur:ajouter.html.twig',array("user"=>$user,"form"=>$form->createView()));
    }

    public function updateVoitureAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        $voiture = $em->getRepository('autoEcoleBundle:Voiture')->findOneById($id);
        $form = $this->createForm(VoitureType::class,$voiture);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em->merge($voiture);
            $em->flush();
            return $this->redirectToRoute('auto_ecole_admin_voiture_liste');
        }
        return $this->render('autoEcoleAdminBundle:Voiture:modifier.html.twig',array("user"=>$user,"form"=>$form->createView()));
    }

    public function listEntrainementAction()
    {
        $user = $this->getUser();
        $em=$this->getDoctrine()->getManager();
        $entrainements = $em->getRepository('autoEcoleBundle:Entrainement')->findAll();
        return $this->render('autoEcoleAdminBundle:Entrainement:liste.html.twig',array("user"=>$user,"entrainements"=>$entrainements));
    }

}
