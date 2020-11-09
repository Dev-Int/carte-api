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

namespace Application\ReadModel\Menu;

use Domain\Entity\Menu;

final class Menus
{
    /**
     * @var Menu[]
     */
    private $values;

    public function __construct(Menu ...$menus)
    {
        $this->values = $menus;
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
