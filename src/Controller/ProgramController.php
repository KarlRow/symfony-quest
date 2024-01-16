<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;

use App\Form\ProgramType;

use App\Service\ProgramDuration;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', ['programs' => $programs]);
    }

    #[Route('/{program}/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger) : Response
    {
        
        $program = new Program();

        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        $slug = $slugger->slug($program->getTitle() !== null);
        $program->setSlug($slug);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($program);
            $entityManager->flush(); 
            
            $this->addFlash("success", "The new program has been created");

            // Redirect to categories list
            return $this->redirectToRoute('program_index');
        } 

        // Render the form
        return $this->render('program/new.html.twig', [
            'form' => $form,
        ]);
    }

    

    #[Route('/program/{slug}',  methods: ['GET'], name: 'program_show', requirements: ['program' => '\d+'])]
    public function show(Program $program, ProgramDuration $programDuration): Response
    {
        
        return $this->render('program/show.html.twig', ['program' => $program, 'programDuration' => $programDuration->calculate($program)]);
    }

    #[Route('/program/{slug}/season/{season}', methods: ['GET'], name: 'program_season_show')]
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

    #[Route('/program/{slug}/season/{season}/episode/{episodeSlug}', methods: ['GET'], name: 'program_episode_show')]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
    
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

    #[Route('/{id}/edit', name: 'app_program_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Program $program, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "The program has been updated");

            return $this->redirectToRoute('program_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('program/edit.html.twig', [
            'program' => $program,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_program_delete', methods: ['POST'])]
    public function delete(Request $request, Program $program, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$program->getId(), $request->request->get('_token'))) {
            $entityManager->remove($program);
            $entityManager->flush();
        }

        return $this->redirectToRoute('program_index', [], Response::HTTP_SEE_OTHER);
    }
}
