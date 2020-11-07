<?php

namespace Domain\Protocol\Repository;

use Domain\Entity\Carte;

interface CarteRepositoryProtocol
{
    /**
     * Save the Carte object in database.
     */
    public function save(Carte $carte): void;

    /**
     * Delete the Carte object in database.
     */
    public function remove(Carte $carte): void;
}
