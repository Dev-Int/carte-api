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

namespace Domain\Protocol\Repository;

use Domain\Entity\Product;

interface ProductRepositoryProtocol
{
    /**
     * Save the Product object in database.
     */
    public function save(Product $product): void;

    /**
     * Delete the Product object in database.
     */
    public function remove(Product $product): void;
}
