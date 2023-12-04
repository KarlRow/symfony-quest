<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\EpisodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;

class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', ['programs' => $programs]);
    }

    #[Route('/program/{id<\d+>}',  methods: ['GET'], name: 'program_show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        return $this->render('program/show.html.twig', ['program' => $program]);
    }

    #[Route('/program/{programId<\d+>}/seasons/{seasonId<\d+>}', methods: ['GET'], name: 'program_season_show')]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);
        $episodes = $episodeRepository->findAll();

        if (!$season) {
            throw $this->createNotFoundException(
                'No program with id : '.$seasonId.' found in program\'s table.'
            );
        }
        return $this->render('program/season_show.html.twig', ['program' => $program, 'season' => $season, 'episodes' => $episodes,]);
    }

}