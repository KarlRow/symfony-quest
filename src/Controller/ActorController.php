<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Program;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ActorRepository;


class ActorController extends AbstractController
{

    #[Route('/actor/', name: 'actor_index')]
    public function index(ActorRepository $actorRepository): Response
    {
        $actors = $actorRepository->findAll();

        return $this->render('actor/index.html.twig', ['actors' => $actors]);
    }

    #[Route('/actor/{id}',  methods: ['GET'], name: 'actor_show')]
    public function show(Actor $actor): Response
    {

        return $this->render('actor/show.html.twig', ['actor' => $actor]);
    }
}