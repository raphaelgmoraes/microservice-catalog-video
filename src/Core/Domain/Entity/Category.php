<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicTrait;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class Category
{
    use MethodsMagicTrait;

    public function __construct(
        protected Uuid|string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $active = true,
        protected DateTime|string $createdAt = '',
    ) {
        $this->id = empty($this->id) ? Uuid::random() : new Uuid($this->id);
        $this->createdAt = empty($this->createdAt) ? new DateTime() : new DateTime($this->createdAt);

        $this->validate();
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function disable(): void
    {
        $this->active = false;
    }

    public function update(string $name, string $description = '')
    {
        $this->name = $name;
        $this->description = $description;

        $this->validate();
    }

    protected function validate()
    {
        DomainValidation::strMaxLength($this->name);
        DomainValidation::strMinLength($this->name);
        DomainValidation::strCanNullAndMaxLength($this->description);
    }
}
