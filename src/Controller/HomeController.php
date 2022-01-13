<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\VCodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        try{
            $user = $this->userRepository->findBy([
                'username' => $_SESSION['_sf2_attributes']['_security.last_username']
            ]);
        }catch(\Exception $exception){
            $this->addFlash('error', 'Nicht angemeldet');
        }

        if(empty($user)){
            $user = null;
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user' => $user
        ]);
    }

    /**
     * @Route("/inaktiv", name="inaktiv")
     */
    public function inaktiv(): Response
    {
        $this->addFlash('error', 'Dieser Nutzer ist Inaktiv gestellt worden. Melde dich beim Admin.');
        return new RedirectResponse($this->generateUrl('app_logout'));
    }
}
