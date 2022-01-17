<?php


namespace App\Service\Helper;


use App\Repository\VCodeRepository;
use Doctrine\ORM\EntityManagerInterface;

class VCodeHelper
{

    private $vcr;
    private $em;

    public function __construct(EntityManagerInterface $em, VCodeRepository $vcr)
    {
        $this->vcr = $vcr;
        $this->em = $em;
    }

    public function deleteVCode($registerCodeInput): ? bool {
        //Entity löschen
            try {
                $deletingCode = $this->vcr->findBy([
                    'code' => $registerCodeInput
                ]);
            }catch (\Exception $exception){
                return "Es ist ein Fehler bei der Verbindung zur Datenbank aufgetreten.";
            }

            /*Alle Zurückgegebene Codes die Identisch sind zu "$registerCode"
              bzw. "$deletingCode" werden gelöscht
                !!!(( Normaler weise ist dieser Code jedoch nur einmalig ))!!!
            */
            foreach ($deletingCode as $code){
                $this->em->remove($code);
                $this->em->flush();
            }

        return true;
    }

    public function validateCode($registerCodeInput): bool{
        $notExists = $this->vcr->getVCode($registerCodeInput);
        return $notExists;
    }
}