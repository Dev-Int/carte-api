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

namespace Infrastructure\Controllers\Product;

use Application\ReadModel\Product\Product;
use Domain\Entity\Common\EntityUuid;
use Domain\Entity\Common\VO\LabelEntity;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class GetProductsListController extends AbstractController
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
        $products[] = $serializer->serialize($product, 'json');
        $products[] = $serializer->serialize($product2, 'json');

        return new JsonResponse($products);
    }
}
