<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Repository\ActorRepository;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use App\Form\ProgramType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/actor', name: 'actor_')]
class ActorController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ActorRepository $actorRepository, RequestStack $requestStack): Response
    {
        $actors = $actorRepository->findAll();
        $session = $requestStack->getSession();


        return $this->render('actor/index.html.twig', [
            'website' => 'Wild Series',
            'actors' => $actors,
        ]);
    }

    #[Route('/show/{id<^[0-9]+$>}/', name: 'show', requirements: ['id'=>'\d+'], methods: ['GET'])]
    public function show(Actor $actor): Response
    {

        if (!$actor) {
            throw $this->createNotFoundException(
                'No actor with id : '.$actor.' found in program\'s table.'
            );
        }


        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
        ]);
    }
}