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

namespace Domain\Entity\Common\VO;

use Cocur\Slugify\Slugify;
use Domain\Entity\Common\StringExceeds255Characters;

final class LabelEntity
{
    /**
     * @var string
     */
    private $label;

    public function __construct(string $label)
    {
        if (\strlen($label) > 255) {
            throw new StringExceeds255Characters();
        }
        $this->label = $label;
    }

    public static function fromString(string $label): self
    {
        return new self($label);
    }

    public function getValue(): string
    {
        return $this->label;
    }

    public function slugify(): string
    {
        $slugify = new Slugify();

        return $slugify->slugify($this->label);
    }
}
