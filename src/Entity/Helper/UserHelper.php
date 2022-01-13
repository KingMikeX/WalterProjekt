<?php

namespace App\Entity\Helper;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserHelper
{
    private $userRepo;
    private $em;

    public function __construct(EntityManagerInterface $em, UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
        $this->em = $em;
    }

    public function validateUsername($input): ?bool{

        // Variablen Initialisieren ( Für Validierung )
        $validatingName = $input->getUsername();
        $musters = "/[ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz._-]/";

        // Jede Art von erlaubten Zeichen mit allen Zeichen, jedesmal hochzählen wenn eins Stimmt
        $addingMatches = preg_match_all($musters, $validatingName, $matches[][], PREG_PATTERN_ORDER, 0);

        //dump($addingMatches);
        // Hochgezählte Menge sollt identisch zu der count-Menge des "Username" sein
        // Sofern alle Zeichen der erlaubten Zeichen entsprechen.
        if($addingMatches === count(str_split($validatingName))){
            $notExists = $this->userRepo->findBy([
                'username' => $validatingName
            ]);
            if(empty($notExists)){
                return true;
            }else{
                return null;
            }
        }else{
            return false;
        }
    }
}