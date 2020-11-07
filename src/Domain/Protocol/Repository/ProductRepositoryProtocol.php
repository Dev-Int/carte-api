<?php

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
