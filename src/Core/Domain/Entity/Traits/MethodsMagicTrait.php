<?php

namespace Core\Domain\Entity\Traits;

use Core\Domain\Exception\EntityMethodsMagicTraitException;

trait MethodsMagicTrait
{
    /**
     * @throws \Exception
     */
    public function __get(string $property): mixed
    {
        if (! property_exists($this, $property)) {
            throw new EntityMethodsMagicTraitException('Property does not exist in class: '.get_class($this));
        }

        return $this->{$property};
    }

    public function id(): string
    {
        return (string) $this->id;
    }

    public function createdAt(): string
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }
}
