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

namespace Domain\Entity\Common;

use Domain\Entity\Protocols\UuidProtocol;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class AbstractUuid implements UuidProtocol
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    final public function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function fromUuid(UuidInterface $uuid): UuidProtocol
    {
        return new static($uuid);
    }

    public static function fromString(string $uuid): UuidProtocol
    {
        return new static(Uuid::fromString($uuid));
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }
}
