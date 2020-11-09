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

namespace Infrastructure\Controllers\Carte;

use Application\ReadModel\Carte\Carte;
use Application\ReadModel\Menu\Menu;
use Application\ReadModel\Product\Product;
use Domain\Entity\Common\EntityUuid;
use Domain\Entity\Common\VO\LabelEntity;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class GetCartesListController extends AbstractController
{
    public function __invoke(SerializerInterface $serializer): JsonResponse
    {
        $product = Product::create(
            EntityUuid::fromUuid(Uuid::uuid4()),
            LabelEntity::fromString('pizza'),
            new \DateTimeImmutable()
        );
        $product2 = Product::create(
            EntityUuid::fromUuid(Uuid::uuid4()),
            LabelEntity::fromString('pasta'),
            new \DateTimeImmutable()
        );

        $menu = Menu::create(
            EntityUuid::fromUuid(Uuid::uuid4()),
            LabelEntity::fromString('Tradition'),
            [$product, $product2],
            new \DateTimeImmutable()
        );
        $menu2 = Menu::create(
            EntityUuid::fromUuid(Uuid::uuid4()),
            LabelEntity::fromString('Classique'),
            [$product, $product2],
            new \DateTimeImmutable()
        );

        $carte = Carte::create(
            EntityUuid::fromUuid(Uuid::uuid4()),
            LabelEntity::fromString('Carte d\'été'),
            [$product, $product2],
            new \DateTimeImmutable(),
            [$menu, $menu2]
        );
        $carte2 = Carte::create(
            EntityUuid::fromUuid(Uuid::uuid4()),
            LabelEntity::fromString('Carte d\'été 2'),
            [$product, $product2],
            new \DateTimeImmutable(),
            [$menu, $menu2]
        );

        $cartes[] = $serializer->serialize($carte, 'json');
        $cartes[] = $serializer->serialize($carte2, 'json');

        return new JsonResponse($cartes);
    }
}
