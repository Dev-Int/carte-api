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

namespace Domain\Entity;

use Domain\Entity\Protocols\UuidProtocol;
use Domain\Entity\Traits\SoftDeletableEntity;
use Domain\Entity\Traits\TimestampableEntity;

class Carte
{
    use SoftDeletableEntity;
    use TimestampableEntity;

    /**
     * @var string
     */
    private $uuid;
    /**
     * @var string
     */
    private $label;
    /**
     * @var array
     */
    private $products;
    /**
     * @var null|array
     */
    private $menus;

    public function __construct(
        UuidProtocol $uuid,
        string $label,
        array $products,
        \DateTimeImmutable $createdAt,
        array $menus = [],
        ?\DateTimeImmutable $updatedAt = null,
        ?\DateTimeImmutable $deletedAt = null
    ) {
        $this->uuid = $uuid->toString();
        $this->label = $label;
        $this->products = $products;
        $this->menus = $menus;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
    }

    public static function create(
        UuidProtocol $uuid,
        string $label,
        array $products,
        \DateTimeImmutable $createdAt,
        array $menus = [],
        ?\DateTimeImmutable $updatedAt = null,
        ?\DateTimeImmutable $deletedAt = null
    ): self {
        return new self(
            $uuid,
            $label,
            $products,
            $createdAt,
            $menus,
            $updatedAt,
            $deletedAt
        );
    }

    public function changeLabel(string $label, \DateTimeImmutable $updatedAt): void
    {
        $this->label = $label;
        $this->updatedAt = $updatedAt;
    }

    public function updateProducts(array $products, \DateTimeImmutable $updatedAt): void
    {
        $this->products = $products;
        $this->updatedAt = $updatedAt;
    }

    public function updateMenus(array $menus, \DateTimeImmutable $updatedAt): void
    {
        $this->menus = $menus;
        $this->updatedAt = $updatedAt;
    }
}
