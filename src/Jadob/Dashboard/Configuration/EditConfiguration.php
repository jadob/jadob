<?php
declare(strict_types=1);


namespace Jadob\Dashboard\Configuration;

use Jadob\Dashboard\Exception\ConfigurationException;

class EditConfiguration
{
    protected bool $inheritNewForm = false;

    /**
     * @param array $data
     * @return static
     * @throws ConfigurationException
     */
    public static function fromArray(array $data): self
    {
        if (
            !isset($data['inherit_new_form'])
            && !is_bool($data['inherit_new_form'])
        ) {
            throw new ConfigurationException('Invalid Edit Form configuration passed.');
        }

        $self = new self();
        $self->inheritNewForm = $data['inherit_new_form'];

        return $self;
    }

    /**
     * @return bool
     */
    public function isInheritNewForm(): bool
    {
        return $this->inheritNewForm;
    }
}
