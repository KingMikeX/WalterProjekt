<?php


namespace App\Entity\Helper;

use App\Repository\DeposRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class DepoHelper
{
    private EntityManagerInterface $em;
    private UserRepository $userRepo;
    private DeposRepository $depoRepo;

    public function __construct(EntityManagerInterface $em, UserRepository $userRepo, DeposRepository $depoRepo){
        $this->em = $em;
        $this->userRepo = $userRepo;
        $this->depoRepo = $depoRepo;
    }

    public function getAllDepos(String $username){

        $alldepos = $this->depoRepo->findByUsername($username);

        return $alldepos;
    }

}