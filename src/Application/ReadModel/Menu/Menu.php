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

use Domain\Entity\Common\VO\LabelEntity;
use Domain\Entity\Protocols\UuidProtocol;

final class Menu
{
    /**
     * @var string
     */
    public $uuid;
    /**
     * @var string
     */
    public $label;
    /**
     * @var array
     */
    public $products;
    /**
     * @var \DateTimeImmutable
     */
    public $createdAt;
    /**
     * @var \DateTimeImmutable|null
     */
    public $updatedAt;
    /**
     * @var \DateTimeImmutable|null
     */
    public $deletedAt;
    /**
     * @var string
     */
    public $slug;

    public function __construct(
        string $uuid,
        string $label,
        array $products,
        \DateTimeImmutable $createdAt,
        string $slug,
        ?\DateTimeImmutable $updatedAt = null,
        ?\DateTimeImmutable $deletedAt = null
    ) {
        $this->uuid = $uuid;
        $this->label = $label;
        $this->products = $products;
        $this->slug = $slug;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
    }

    public static function create(
        UuidProtocol $uuid,
        LabelEntity $label,
        array $products,
        \DateTimeImmutable $createdAt,
        ?\DateTimeImmutable $updatedAt = null,
        ?\DateTimeImmutable $deletedAt = null
    ): self {
        return new self(
            $uuid->toString(),
            $label->getValue(),
            $products,
            $createdAt,
            $label->slugify(),
            $updatedAt,
            $deletedAt
        );
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
