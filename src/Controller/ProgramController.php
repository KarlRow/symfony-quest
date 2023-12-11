<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;

use App\Form\ProgramType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;


class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', ['programs' => $programs]);
    }

    #[Route('/program/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->persist($program);
            $entityManager->flush();            

            // Redirect to categories list
            return $this->redirectToRoute('program_index');
        }

        // Render the form
        return $this->render('program/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/program/{program}',  methods: ['GET'], name: 'program_show')]
    public function show(Program $program): Response
    {
        $seasons = $program->getSeasons();
        
        return $this->render('program/show.html.twig', ['program' => $program, 'seasons' => $seasons]);
    }

    #[Route('/program/{program}/season/{season}', methods: ['GET'], name: 'program_season_show')]
    public function showSeason(Program $program, Season $season) : Response
    {

        if (!$season) {
            throw $this->createNotFoundException(
                'No program with id : '.$season.' found in program\'s table.'
            );
        }
        return $this->render('program/season_show.html.twig', 
        [
            'program' => $program, 
            'season'  => $season, 
        ]);
    }

    #[Route('/program/{program}/season/{season}/episode/{episode}', methods: ['GET'], name: 'program_episode_show')]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        // Note : Vous ne devriez pas réaffecter $episode ici
        // $episode = $season->getEpisodes();
    
        if (!$episode) {
            throw $this->createNotFoundException(
                'No episode with id : '.$episode.' found in episode\'s table.'
            );
        }
    
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season'  => $season,
            'episode' => $episode,
        ]);
    }
    

}