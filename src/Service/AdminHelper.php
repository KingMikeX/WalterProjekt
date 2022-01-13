<?php

namespace App\Service;


use _HumbugBox373c0874430e\phpDocumentor\Reflection\Types\Integer;
use App\Entity\Depos;
use App\Repository\DeposRepository;
use App\Repository\MessagesRepository;
use App\Repository\TransfersRepository;
use App\Repository\UserRepository;
use App\Repository\VCodeRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;

class AdminHelper
{

    private $repositorys = [];
    private UserRepository $userRepo;
    private DeposRepository $depoRepo;
    private EntityManagerInterface $em;
    private VCodeRepository $vcodeRepository;
    private TransfersRepository $transfersRepository;
    private MessagesRepository $messagesRepository;

    public function __construct(EntityManagerInterface $em, UserRepository $userRepo, DeposRepository $depoRepo,
                                TransfersRepository $transfersRepository, VCodeRepository $vcodeRepository, MessagesRepository $messagesRepository){
        $this->em = $em;
        $this->userRepo = $userRepo;
        $this->depoRepo = $depoRepo;
        $this->transfersRepository = $transfersRepository;
        $this->vcodeRepository = $vcodeRepository;
        $this->messagesRepository = $messagesRepository;

        $this->repositorys['userRepo'] = $this->userRepo;
        $this->repositorys['depoRepo'] = $this->depoRepo;
        $this->repositorys['transferRepo'] = $this->transfersRepository;
        $this->repositorys['vcodeRepo'] = $this->vcodeRepository;
        $this->repositorys['messageRepo'] = $this->messagesRepository;
    }
//////////        Dynamic Funktions to the Repository Requests
    public function getEditObj(int $editingID, string $repo)    {
        $obj = $this->repositorys[$repo]->findBy([
            'id' => $editingID
        ]);
        return $obj;
    }

    public function getAllObjects($repo){
        $allObjects = $this->repositorys[$repo]->findAll();
        dump($allObjects);
        return $allObjects;
    }

    public function deleteObject(int $id, string $repo){
        $depo = $this->repositorys[$repo]->findBy([
            'id' => $id
        ]);
        $this->em->remove($depo[0]);
        $this->em->flush();
        return $this->getAllObjects($repo);
    }

/////////        Fix Function
    public function saveDepoEdit(int $id, string $name, int $amount, int $payedAmount,
                                 float $lifetime, float $rateAmount){
        $depo = $this->depoRepo->findBy([
            'id' => $id
        ]);

        $depo[0]->setName($name);
        $depo[0]->setAmount($amount);
        $depo[0]->setPayedAmount($payedAmount);
        $depo[0]->setCDate($lifetime);
        $depo[0]->setRateAmount($rateAmount);

        $this->em->persist($depo[0]);
        $this->em->flush();

        $allDepos = $this->getAllObjects('depoRepo');

        return $allDepos;
    }

    // generiere Einen Zufülligen Code für die Registirerung

    public function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrs092u3tuvwxyzaskd
        hfhf9882323ABCDEFGHIJKLMNksadf9044OPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function saveVcode($vcode){

        $this->em->persist($vcode);
        $this->em->flush();

        $vcodes = $this->vcodeRepository->findAll();

        return $vcodes;
    }

    public function saveMessage(\App\Entity\Messages $message)
    {
        try{
            $this->em->persist($message);
            $this->em->flush();
        }catch(Exception $exception){
            return false;
        }
        return true;
    }

    public function saveTransferEdit(int $id, $name){
/////////             ---- !!!!!!!!!!!!!!!!!!
    }

    public function saveUserEdit(int $id, string $username, $roles, string $password,
                                 string $email, float $balance, ?bool $active)
    {
        $arrayRoles = ['user' => $roles];
        $user = $this->userRepo->findBy([
            'id' => $id
        ]);

        dump($user);
        dump("Active");
        dump($active);
        dump($arrayRoles);
        $user[0]->setUsername($username);
        $user[0]->setPassword($password);
        $user[0]->setEmail($email);
        $user[0]->setBalance($balance);
        if(isset($active)){
            if($roles !== 'aktuell'){
                $user[0]->setRoles($arrayRoles);
            }
            $user[0]->setActive($active);
        }else{
            $user[0]->setActive(false);
        }
        $this->em->persist($user[0]);
        $this->em->flush();

        $allUsers = $this->userRepo->findAll();

        return $allUsers;
    }
}