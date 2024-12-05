<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/event')]

class EventController extends AbstractController
{
    #[Route('/', name: 'app_event')]
    public function listEvents(EventRepository $eventRepo): Response
    {
        $listEvents = $eventRepo->findAll();
        return $this->render('event/listEvents.html.twig', [
            'listeE' => $listEvents,
        ]);
    }

    #[Route('/new', name: 'app_new')]
    public function new(Request $request, EntityManagerInterface $em) {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('app_event');
        }
        return $this->render('event/new.html.twig',
            ['formE' => $form->createView()]);
    }

    #[Route('/search', name: 'searchE')]
    public function searchEvents(Request $request, EntityManagerInterface $entityManager): Response {
        $eventName = $request->request->get('nom');
        $query = $entityManager->createQuery('select e from App\Entity\Event e where e.nom like :name');
        $query->setParameter('name', '%'.$eventName.'%');
        $eventList = $query->getResult();

        return $this->render('event/searchEvent.html.twig', [
            'eventList' => $eventList,
//            'eventName' => $eventName,
        ]);
    }



}
