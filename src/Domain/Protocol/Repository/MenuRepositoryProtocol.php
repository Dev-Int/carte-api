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

use Domain\Entity\Menu;

interface MenuRepositoryProtocol
{
    /**
     * Save the Menu object in database.
     */
    public function save(Menu $menu): void;

    /**
     * Delete the Menu object in database.
     */
    public function remove(Menu $menu): void;
}
