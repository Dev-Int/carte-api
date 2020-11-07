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

namespace Domain\Entity\Protocols;

use Ramsey\Uuid\UuidInterface;

interface UuidProtocol
{
    public static function fromUuid(UuidInterface $uuid): self;

    public static function fromString(string $uuid): self;

    public function toString(): string;
}
