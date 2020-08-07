<?php

namespace autoEcoleBundle\Controller;

use autoEcoleBundle\Entity\Entrainement;
use autoEcoleBundle\Entity\Rating;
use autoEcoleBundle\Form\RatingType;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        $rating = new Rating();
        if(null!=$user){
            return $this->render('autoEcoleBundle:Default:index.html.twig',array("user"=>$user));
        }
        else{
            return $this->render('autoEcoleBundle:Default:index.html.twig',array("user"=>$user));
        }
    }

    public function mesReservationsAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $reservations =$em->getRepository('autoEcoleBundle:Entrainement')->findBy(array("user"=>$user->getId()));
        return $this->render('@autoEcole/Default/reservations.html.twig',array("user"=>$user,"reservations"=>$reservations));
    }

    public function moniteurDispoAction($datedebut,$nombreheure)
    {
        $em = $this->getDoctrine()->getManager();
        $moniteursArray = $em->getRepository('autoEcoleBundle:Moniteur')
            ->getMoniteursDipo($datedebut,$nombreheure);
        $arrayCollection = array();
        foreach($moniteursArray as $moniteur) {
            $arrayCollection[] = array(
                'id' => $moniteur["id"],
                'nom' => $moniteur["nom"],
                'prenom' => $moniteur["prenom"]
            );
        }
        return new JsonResponse($arrayCollection);
    }


    public function getMarquesAction(){
        $em = $this->getDoctrine()->getManager();
        $marques = $em->getRepository('autoEcoleBundle:Voiture')->getMarques();
        return new JsonResponse($marques);
    }
    public function getModelesAction($marque){
        $em = $this->getDoctrine()->getManager();
        $modeles = $em->getRepository('autoEcoleBundle:Voiture')->getModelesByMarque($marque);
        return new JsonResponse($modeles);
    }

    public function horaireAction($modele)
    {
        $em = $this->getDoctrine()->getManager();
        $voiture = $em->getRepository('autoEcoleBundle:Voiture')->findOneByModele($modele);
        $entrainements = $em->getRepository('autoEcoleBundle:Entrainement')->findBy(array('voiture'=>$voiture));
        $arrayCollection = array();
        foreach($entrainements as $entrainement) {
            if($entrainement->getDateFin()>new Date())
                $arrayCollection[] = array(
                    'dateDebut' => date_format($entrainement->getDateDebut(),"d/m/Y H:i"),
                    'dateFin' => date_format($entrainement->getDateFin(),"d/m/Y H:i")
                );
        }
        return new JsonResponse($arrayCollection);
    }
    public function getInfoByModeleAction($modele){
        $em = $this->getDoctrine()->getManager();
        $voiture = $em->getRepository('autoEcoleBundle:Voiture')->findOneByModele($modele);
        $arrayCollection = array(
            'id' => $voiture->getId(),
            'couleur' => $voiture->getCouleur(),
            'marque' => $voiture->getMarque(),
            'modele' => $voiture->getModele(),
            'prix' => $voiture->getPrix(),
        );
        return new JsonResponse($arrayCollection);
    }
    //TODO : REserver
    public function reserverAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $nombreHeures = $request->get("nombreHeures");
        $voiture = $em->getRepository('autoEcoleBundle:Voiture')->findOneByModele($request->get("modele"));
        try {
            $entrainements = $em->getRepository('autoEcoleBundle:Voiture')->getEntrainementByVoiture($voiture->getId());

        } catch (DBALException $e) {
        }

        $dateChoisie = $request->get("dateChoisie");
        $disponible = true;
        foreach($entrainements as $entrainement){
            $disponible=$this->inRangeDate($dateChoisie,$nombreHeures,$entrainement["dateDebut"],$entrainement["dateFin"]);
        }
        if($disponible==false)
            return new Response("Voiture Indisponible");
        $moniteur = $em->getRepository('autoEcoleBundle:Moniteur')->findOneById($request->get("moniteur"));
        $dateDebut = new \DateTime($request->get("dateChoisie"));
        $dateFin = new \DateTime($request->get("dateChoisie"));
        $dateFin->add(new \DateInterval('PT'.$nombreHeures.'H'));
        $entrainement = new Entrainement();
        $entrainement->setNombreHeure($nombreHeures);
        $entrainement->setVoiture($voiture);
        $entrainement->setDateDebut($dateDebut);
        $entrainement->setDateFin($dateFin);
        $entrainement->setUser($this->getUser());
        $entrainement->setMoniteur($moniteur);
        $em->persist($entrainement);
        $em->flush();
        return $this->redirectToRoute('auto_ecole_mes_reservations');
    }

    //TODO:DateCheck in Range
    /**
     * @param $dateChoisie
     * @param $nombreHeures
     * @param $dateDebut
     * @param $dateFin
     * @return bool
     */
    private function inRangeDate($dateChoisieStr,$nombreHeures,$dateDebut,$dateFin){
        $disponible = true;
        $dateChoisie = new \DateTime($dateChoisieStr);
        $dateFinChoisie = new \DateTime($dateChoisieStr);
        $dateFinChoisie->add(new \DateInterval('PT'.$nombreHeures.'H'));
        $dateDebut = new \DateTime($dateDebut);
        $dateFin = new \DateTime($dateFin);
        if((($dateChoisie>$dateDebut&&$dateChoisie<$dateFin)||($dateFinChoisie>$dateDebut&&$dateFinChoisie<$dateFin)))
            $disponible=false;
        return $disponible;
    }
}
