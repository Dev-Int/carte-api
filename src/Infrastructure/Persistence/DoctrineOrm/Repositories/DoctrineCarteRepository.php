<?php

declare(strict_types=1);

/*
 * This file is part of the Carte-API Apps package.
 *
 * (c) Dev-Int Création <devint.creation@gmail.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Infrastructure\Persistence\DoctrineOrm\Repositories;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Entity\Carte;
use Domain\Protocol\Repository\CarteRepositoryProtocol;

/**
 * @method Carte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carte[]    findAll()
 * @method Carte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineCarteRepository extends ServiceEntityRepository implements CarteRepositoryProtocol
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carte::class);
    }

    /**
     * @throws ORMException
     */
    public function save(Carte $carte): void
    {
        $this->getEntityManager()->persist($carte);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws ORMException
     */
    public function remove(Carte $carte): void
    {
        $this->getEntityManager()->remove($carte);
        $this->getEntityManager()->flush();
    }
}
