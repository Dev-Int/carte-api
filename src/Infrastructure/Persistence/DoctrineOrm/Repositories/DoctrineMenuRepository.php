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
use Domain\Entity\Menu;
use Domain\Protocol\Repository\MenuRepositoryProtocol;

/**
 * @method Menu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Menu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Menu[]    findAll()
 * @method Menu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineMenuRepository extends ServiceEntityRepository implements MenuRepositoryProtocol
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Menu::class);
    }

    /**
     * @throws ORMException
     */
    public function save(Menu $menu): void
    {
        $this->getEntityManager()->persist($menu);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws ORMException
     */
    public function remove(Menu $menu): void
    {
        $this->getEntityManager()->remove($menu);
        $this->getEntityManager()->flush();
    }
}
