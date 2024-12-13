<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/reservation')]
class ReservationController extends AbstractController
{
    #[Route('/new', name: 'reservation_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setUser($this->getUser());

            // Validation des contraintes
            $errors = $validator->validate($reservation);
            if (count($errors) > 0) {
                return $this->render('reservation/new.html.twig', [
                    'reservation' => $reservation,
                    'form' => $form->createView(),
                    'errors' => $errors,
                ]);
            }

            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/', name: 'reservation_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(ReservationRepository $reservationRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            // Si l'utilisateur est un administrateur, récupérer toutes les réservations
            $reservations = $reservationRepository->findAll();
        } else {
            // Sinon, récupérer uniquement les réservations de l'utilisateur connecté
            $reservations = $reservationRepository->findBy(['user' => $this->getUser()]);
        }

        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}