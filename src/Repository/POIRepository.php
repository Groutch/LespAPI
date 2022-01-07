<?php

namespace App\Repository;

use App\Entity\POI;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method POI|null find($id, $lockMode = null, $lockVersion = null)
 * @method POI|null findOneBy(array $criteria, array $orderBy = null)
 * @method POI[]    findAll()
 * @method POI[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class POIRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, POI::class);
        $this->manager = $manager;
    }

    public function savePOI($newPOI)
    {
        $this->manager->persist($newPOI);
        $this->manager->flush();
    }

    public function updatePOI(POI $POItoUpdate)
    {
        $this->manager->persist($POItoUpdate);
        $this->manager->flush();
        return $POItoUpdate;
    }

    public function deletePOI(POI $POItoDelete)
    {
        $this->manager->remove($POItoDelete);
        $this->manager->flush();
    }

}
