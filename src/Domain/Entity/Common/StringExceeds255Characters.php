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

class StringExceeds255Characters extends \DomainException
{
    /**
     * @var string
     */
    protected $message = 'Le titre est trop long. Vous ne devriez pas exéder 255 caractères';
}
