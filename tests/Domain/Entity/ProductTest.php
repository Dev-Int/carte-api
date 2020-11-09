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

namespace Tests\Domain\Entity;

use Domain\Entity\Common\EntityUuid;
use Domain\Entity\Common\VO\LabelEntity;
use Domain\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    final public function testInstantiateProduct(): void
    {
        // Arrange & Act
        $product = Product::create(
            EntityUuid::fromString('e5b6c68b-23d0-4e4e-ad5e-436c649da004'),
            LabelEntity::fromString('Mon produit'),
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );

        // Assert
        static::assertEquals(
            new Product(
                EntityUuid::fromString('e5b6c68b-23d0-4e4e-ad5e-436c649da004'),
                LabelEntity::fromString('Mon produit'),
                new \DateTimeImmutable('2020-10-25 15:00:00')
            ),
            $product
        );
    }

    final public function testChangeLabel(): void
    {
        // Arrange
        $product = Product::create(
            EntityUuid::fromString('e5b6c68b-23d0-4e4e-ad5e-436c649da004'),
            LabelEntity::fromString('Mon produit'),
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );

        // Act
        $updatedAt = new \DateTimeImmutable('2020-11-01 01:01:00');
        $product->changeLabel(LabelEntity::fromString('Nouveau produit'), $updatedAt);

        // Assert
        static::assertEquals(
            new Product(
                EntityUuid::fromString('e5b6c68b-23d0-4e4e-ad5e-436c649da004'),
                LabelEntity::fromString('Nouveau produit'),
                new \DateTimeImmutable('2020-10-25 15:00:00'),
                $updatedAt
            ),
            $product
        );
    }

    final public function testProductIsDeleted(): void
    {
        // Arrange && Act
        $product = Product::create(
            EntityUuid::fromString('e5b6c68b-23d0-4e4e-ad5e-436c649da004'),
            LabelEntity::fromString('Mon produit'),
            new \DateTimeImmutable('2020-10-25 15:00:00'),
            new \DateTimeImmutable('2020-10-25 15:00:00'),
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );

        // Assert
        static::assertTrue($product->isDeleted());
    }
}
