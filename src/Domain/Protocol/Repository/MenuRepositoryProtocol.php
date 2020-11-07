<?php

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
