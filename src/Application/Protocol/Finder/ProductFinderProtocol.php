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

namespace Application\Protocol\Finder;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Domain\Entity\Product;

interface ProductFinderProtocol extends ServiceEntityRepositoryInterface
{
    /**
     * Find one Product by his slug.
     */
    public function findOne(string $slug): Product;
}
