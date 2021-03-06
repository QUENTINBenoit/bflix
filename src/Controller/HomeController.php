<?php

namespace App\Controller;

use App\Entity\Tvshow;
use App\Repository\TvshowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(TvshowRepository $tvshowRepository): Response
    {
        $tvshwolist = $tvshowRepository->findAll();

        return $this->render('home/index.html.twig', [
            'tvshowHome' => $tvshwolist,
        ]);
    }

    /**
     * Méthode de recherche 
     *
     * @param Request $resquest
     * @param TvshowRepository $tvshowRepository
     * @return void
     */
    #[Route('/search', name: 'search')]
    public function search(Request $request, TvshowRepository $tvshowRepository)
    {

        // recupération de l'information saisie dans le formulaire
        $searchValue = $request->get('q');

        $tvShows = $tvshowRepository->findSearchByTitle($searchValue);
        return $this->render('home/search.html.twig',  [
            'tvshows' => $tvShows,
            'searchValue' => $searchValue,
        ]);
    }
}
