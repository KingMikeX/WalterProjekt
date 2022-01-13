<?php


namespace App\Service;


use App\Repository\MessagesRepository;
use Doctrine\ORM\EntityManagerInterface;

class MessageHelper
{

    private EntityManagerInterface $em;
    private MessagesRepository $mr;

    public function __construct(EntityManagerInterface $entityManager, MessagesRepository $messagesRepository){
        $this->em = $entityManager;
        $this->mr = $messagesRepository;
    }

    public function getUserMassages(String $loggedUserName){
        $messages = $this->mr->findBy([
            'receiver' => $loggedUserName
        ]);
        return $messages;
    }
}