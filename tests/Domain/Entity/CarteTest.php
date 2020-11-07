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

use Domain\Entity\Carte;
use Domain\Entity\EntityUuid;
use Domain\Entity\Menu;
use Domain\Entity\Product;
use PHPUnit\Framework\TestCase;

class CarteTest extends TestCase
{
    final public function testInstantiateCarte(): void
    {
        // Arrange
        $product = Product::create(
            EntityUuid::fromString('e5b6c68b-23d0-4e4e-ad5e-436c649da004'),
            'Mon produit',
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );
        $product2 = Product::create(
            EntityUuid::fromString('e5b6c68b-8f6e-4e4e-91bc-436c649da004'),
            'Mon produit',
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );

        // Act
        $carte = Carte::create(
            EntityUuid::fromString('a136c6fe-8f6e-45ed-91bc-436c649da004'),
            'Ma carte',
            [$product, $product2],
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );

        // Assert
        static::assertEquals(
            new Carte(
                EntityUuid::fromString('a136c6fe-8f6e-45ed-91bc-436c649da004'),
                'Ma carte',
                [$product, $product2],
                new \DateTimeImmutable('2020-10-25 15:00:00')
            ),
            $carte
        );
    }

    final public function testChangeLabel(): void
    {
        // Arrange
        $product = Product::create(
            EntityUuid::fromString('e5b6c68b-23d0-4e4e-ad5e-436c649da004'),
            'Mon produit',
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );
        $product2 = Product::create(
            EntityUuid::fromString('e5b6c68b-8f6e-4e4e-91bc-436c649da004'),
            'Mon produit',
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );
        $carte = Carte::create(
            EntityUuid::fromString('a136c6fe-8f6e-45ed-91bc-436c649da004'),
            'Ma carte',
            [$product, $product2],
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );

        // Act
        $updatedAt = new \DateTimeImmutable('2020-11-01 01:01:00');
        $carte->changeLabel('Nouvelle carte', $updatedAt);

        // Assert
        static::assertEquals(
            new Carte(
                EntityUuid::fromString('a136c6fe-8f6e-45ed-91bc-436c649da004'),
                'Nouvelle carte',
                [$product, $product2],
                new \DateTimeImmutable('2020-10-25 15:00:00'),
                [],
                $updatedAt
            ),
            $carte
        );
    }

    final public function testUpdateProducts(): void
    {
        // Arrange
        $product = Product::create(
            EntityUuid::fromString('e5b6c68b-23d0-4e4e-ad5e-436c649da004'),
            'Mon produit',
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );
        $product2 = Product::create(
            EntityUuid::fromString('e5b6c68b-8f6e-4e4e-91bc-436c649da004'),
            'Mon produit',
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );
        $carte = Carte::create(
            EntityUuid::fromString('a136c6fe-8f6e-45ed-91bc-436c649da004'),
            'Ma carte',
            [$product, $product2],
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );

        // Act
        $updatedAt = new \DateTimeImmutable('2020-11-01 01:01:00');
        $carte->updateProducts([$product, $product2], $updatedAt);

        // Assert
        static::assertEquals(
            new Carte(
                EntityUuid::fromString('a136c6fe-8f6e-45ed-91bc-436c649da004'),
                'Ma carte',
                [$product, $product2],
                new \DateTimeImmutable('2020-10-25 15:00:00'),
                [],
                $updatedAt
            ),
            $carte
        );
    }

    final public function testUpdateMenus(): void
    {
        // Arrange
        $product = Product::create(
            EntityUuid::fromString('e5b6c68b-23d0-4e4e-ad5e-436c649da004'),
            'Mon produit',
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );
        $product2 = Product::create(
            EntityUuid::fromString('e5b6c68b-8f6e-4e4e-91bc-436c649da004'),
            'Mon produit',
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );
        $menu = Menu::create(
            EntityUuid::fromString('a136c6fe-8f6e-45ed-91bc-586374791033'),
            'Mon menu',
            [$product],
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );
        $carte = Carte::create(
            EntityUuid::fromString('a136c6fe-8f6e-45ed-91bc-436c649da004'),
            'Ma carte',
            [$product, $product2],
            new \DateTimeImmutable('2020-10-25 15:00:00'),
            [$menu]
        );

        // Act
        $updatedAt = new \DateTimeImmutable('2020-11-01 01:01:00');
        $carte->updateMenus([$menu, [$product2]], $updatedAt);

        // Assert
        static::assertEquals(
            new Carte(
                EntityUuid::fromString('a136c6fe-8f6e-45ed-91bc-436c649da004'),
                'Ma carte',
                [$product, $product2],
                new \DateTimeImmutable('2020-10-25 15:00:00'),
                [$menu, [$product2]],
                $updatedAt
            ),
            $carte
        );
    }

    final public function testCarteIsDeleted(): void
    {
        // Arrange && Act
        $product = Product::create(
            EntityUuid::fromString('e5b6c68b-23d0-4e4e-ad5e-436c649da004'),
            'Mon produit',
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );
        $carte = Carte::create(
            EntityUuid::fromString('a136c6fe-8f6e-45ed-91bc-436c649da004'),
            'Ma carte',
            [$product],
            new \DateTimeImmutable('2020-10-25 15:00:00'),
            [],
            new \DateTimeImmutable('2020-10-25 15:00:00'),
            new \DateTimeImmutable('2020-10-25 15:00:00')
        );

        // Assert
        static::assertTrue($carte->isDeleted());
    }
}
