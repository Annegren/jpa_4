<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesAmisController extends AbstractController
{
    #[Route('/mes/amis', name: 'mes_amis')]
    public function index(): Response
    {
        return $this->render('mes_amis/index.html.twig', [
            'controller_name' => 'MesAmisController',
        ]);
    }
}
