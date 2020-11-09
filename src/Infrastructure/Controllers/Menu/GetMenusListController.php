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

namespace Infrastructure\Controllers\Menu;

use Application\ReadModel\Menu\Menu;
use Application\ReadModel\Product\Product;
use Domain\Entity\Common\EntityUuid;
use Domain\Entity\Common\VO\LabelEntity;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class GetMenusListController extends AbstractController
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

        $menus[] = $serializer->serialize($menu, 'json');
        $menus[] = $serializer->serialize($menu2, 'json');

        return new JsonResponse($menus);
    }
}
