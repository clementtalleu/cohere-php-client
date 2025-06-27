<?php

declare(strict_types=1);

namespace Talleu\CohereClient\Bundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Talleu\CohereClient\Bundle\DependencyInjection\TalleuCohereClientExtension;

final class TalleuCohereClientBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new TalleuCohereClientExtension();
        }

        return $this->extension;
    }
}
