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

class Product
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

    public function __construct(
        UuidProtocol $uuid,
        string $label,
        \DateTimeImmutable $createdAt,
        ?\DateTimeImmutable $updatedAt = null,
        ?\DateTimeImmutable $deletedAt = null
    ) {
        $this->uuid = $uuid->toString();
        $this->label = $label;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
    }

    public static function create(
        UuidProtocol $uuid,
        string $label,
        \DateTimeImmutable $createdAt,
        ?\DateTimeImmutable $updatedAt = null,
        ?\DateTimeImmutable $deletedAt = null
    ): self {
        return new self($uuid, $label, $createdAt, $updatedAt, $deletedAt);
    }

    public function changeLabel(string $label, \DateTimeImmutable $updatedAt): void
    {
        $this->label = $label;
        $this->updatedAt = $updatedAt;
    }
}
