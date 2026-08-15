<?php

namespace Jadob\Bridge\Symfony\Form\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;

final class FormsConfig implements ConfigNodeInterface
{
    public function __construct(
        private(set) array $formThemes = []
    )
    {
    }

    public function withFormTheme(string $formTheme): self
    {
        $this->formThemes[] = $formTheme;
    }

    public function getFormThemes(): array
    {
        return $this->formThemes;
    }
}