<?php

namespace App\Controller;

use App\Entity\Alert;
use App\Entity\RedZone;
use App\Form\RedzZoneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class BackEndController extends AbstractController
{
    /**
     * @Route("/", name="back_end")
     */
    public function index(): Response
    {
        return $this->render('back_end/index.html.twig', [
            'controller_name' => 'BackEndController',
        ]);
    }

    /**
     * @Route("/redzone", name="backend_redzone")
     */
    public function addRedZone(Request $request){
        $redzone = new RedZone();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(RedzZoneType::class, $redzone);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($redzone);
            $em->flush();

            return $this->redirectToRoute('back_end');
        }
        return $this->render('back_end/redzone.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/showAlerts", name="backend_show_alerts")
     */
    public function showAlerts(){
        $read = $this->getDoctrine()->getRepository(Alert::class);
        $alerts = $read->findAll();
        
        return $this->render('back_end/showAlerts.html.twig',
        ['alerts'=>$alerts]);
    }

    /**
     * @Route("/stats", name="backend_statistics")
     */
    public function stats(EntityManagerInterface $em){

        $read = $this->getDoctrine()->getRepository(Alert::class);
        $alerts = $read->findAll();
    

        $queryRed = $em->createQuery(
            'SELECT a
            FROM App\Entity\Alert a
            WHERE a.type = :type'
        )->setParameter('type', 0);

        $queryGaz = $em->createQuery(
            'SELECT a
            FROM App\Entity\Alert a
            WHERE a.type = :type'
        )->setParameter('type', 1);
        
        $nbAlertRedZone = count($queryRed->getResult());
        $nbAlertGaz = count($queryGaz->getResult());
        
        return $this->render('back_end/statistiques.html.twig',[
            'nbAlertRedZone' => $nbAlertRedZone,
            'nbAlertGaz' => $nbAlertGaz
        ]);
    }
}
