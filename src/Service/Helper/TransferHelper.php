<?php


namespace App\Service\Helper;


use App\Entity\Transfers;
use App\Entity\User;
use App\Repository\TransfersRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Driver\Mysqli\Exception\UnknownType;
use Doctrine\DBAL\Driver\PDO\Exception;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\EntityManagerInterface;

class TransferHelper
{
    private TransfersRepository $transferRepo;
    private UserRepository $userRepo;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em, UserRepository $userRepo, TransfersRepository $transferRepo)
    {
        $this->transferRepo = $transferRepo;
        $this->userRepo = $userRepo;
        $this->em = $em;
    }

    public function existsUsername($owner): bool{

        //Sieht so aus als wär es ein Boolean, aber es sind die zurückgegebenen
            // Obejekte die durch die Anfrage zurückgesendet werden
        $Exists = $this->userRepo->findBy([
            'username' => $owner
        ]);
        //Hier wir überprüft ob es überhaupt zurück gesendete Objekte gab, wenn ja dann
            // existiert der User , wenn nicht dann ist der Username falsch und wir senden ein false zurück
        if(empty($Exists) === false){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $sender
     * @param $receiver
     * @return bool|mixed|string|null
     * [1] Returns FALSE if Receiver Account isn't existing
     * [2] Returns TRUE, when SENDER Account isn't existing --> Error at transfering the Logged in User's Username.
     * [3] Returns NULL, when there was an Error getting the SENDER's or RECEIVER's data.
     * [4] Returns STRING
     * 'senderAccError' = Error at updating the new Sender ( User )-Balance
     * 'reveiverAccError' = Error at updating the new Receiver-Balance
     * [5] Returns ( User/Entity ) Actual Loged in User
     */
    public function transfer($sender, $receiver){

        // Hier weiter machen Empfänger und Absender geld ab- und hinzu-ziehen
        $senderAcc = $this->userRepo->findBy([
            'username' => $sender
        ]);

        if((empty($senderAcc)) === false){

            if($receiver->getReceiver() === $sender){
                return 'senderEqual';
            }
            //dump($receiver->getReceiver());
            try{
                $receiverAcc = $this->userRepo->findBy([
                    'username' => $receiver->getReceiver()
                ]);
            }catch(\Doctrine\DBAL\Exception $ex){
                return null;
            }
            //dump($receiverAcc);

            if(empty($receiverAcc)=== false){

                // Empfängers und Sender Balance initialisieren
                $receiverBalance = $receiverAcc[0]->getBalance();
                $senderBalance = $senderAcc[0]->getBalance();

                // Sender Balance auf Beständigkeit überprüfen
                if($receiver->getAmount() <= $senderBalance){

                    // Empfänger und Sender Balance umrechnen
                    $receiverBalance = $receiverBalance + $receiver->getAmount();
                    $senderBalance = $senderBalance - $receiver->getAmount();

                    // Empfänger und Sender Balance aktualisieren
                    $receiverAcc[0]->setBalance($receiverBalance);
                    $senderAcc[0]->setBalance($senderBalance);

                    //    Speichern -- Save Sender Account in DB with new Balance
                    try{
                        $this->em->persist($senderAcc[0]);
                        $this->em->flush();
                    }catch(Exception $exception){
                        return 'senderAccError';
                    }

                    //   Speichern -- Save Receiver Account in DB with new Balance
                    try{
                        $this->em->persist($receiverAcc[0]);
                        $this->em->flush();
                    }catch(Exception $exception){
                        return 'receiverAccError';
                    }
                }else{
                    return null;
                }
            }else{
                return false;
            }
        }else{
            return true;
        }

        // Sendet den User Accont wieder zurück damit man die daten im Frontend aktualisieren kann.
        return $senderAcc;
    }

    /**
     * @param $transferData :: Daten des Transfers ( Amount, Sender, etc. )
     * @param $date :: Date and Time at the moment of the transaction
     * @return bool TRUE -> 'Worked'  |  FALSE -> 'Error'
     */
    public function saveHistory( $owner, Transfers $transfer): bool{

        $transfer->setOwner($owner);
        $transfer->setDate(date('H:m:s m.d.y'));

        try {
            $this->em->persist($transfer);
            $this->em->flush();
        }catch (\Exception $exception){
            return false;
        }

        return true;
    }

}