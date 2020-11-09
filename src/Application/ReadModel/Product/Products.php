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

namespace Application\ReadModel\Product;

use Domain\Entity\Product;

final class Products
{
    /**
     * @var Product[]
     */
    private $values;

    public function __construct(Product ...$products)
    {
        $this->values = $products;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->values);
    }

    public function toArray(): array
    {
        return $this->values;
    }
}
