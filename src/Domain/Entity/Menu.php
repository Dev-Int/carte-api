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

use Domain\Entity\Common\VO\LabelEntity;
use Domain\Entity\Protocols\UuidProtocol;
use Domain\Entity\Traits\SoftDeletableEntity;
use Domain\Entity\Traits\TimestampableEntity;

class Menu
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
     * @var string
     */
    private $slug;

    public function __construct(
        UuidProtocol $uuid,
        LabelEntity $label,
        array $products,
        \DateTimeImmutable $createdAt,
        ?\DateTimeImmutable $updatedAt = null,
        ?\DateTimeImmutable $deletedAt = null
    ) {
        $this->uuid = $uuid->toString();
        $this->label = $label->getValue();
        $this->products = $products;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
        $this->slug = $label->slugify();
    }

    public static function create(
        UuidProtocol $uuid,
        LabelEntity $label,
        array $products,
        \DateTimeImmutable $createdAt,
        ?\DateTimeImmutable $updatedAt = null,
        ?\DateTimeImmutable $deletedAt = null
    ): self {
        return new self($uuid, $label, $products, $createdAt, $updatedAt, $deletedAt);
    }

    public function changeLabel(LabelEntity $label, \DateTimeImmutable $updatedAt): void
    {
        $this->label = $label->getValue();
        $this->slug = $label->slugify();
        $this->updatedAt = $updatedAt;
    }

    public function updateProducts(array $products, \DateTimeImmutable $updatedAt): void
    {
        $this->products = $products;
        $this->updatedAt = $updatedAt;
    }
}
